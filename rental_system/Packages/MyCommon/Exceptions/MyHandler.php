<?php

namespace MyCommon\Exceptions;

use App\Exceptions\Handler;
use Illuminate\Contracts\Container\Container;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Validation\ValidationException;
use Monolog\Formatter\LineFormatter;
use MyCommon\Libraries\Utils\RequestUtils;
use Psr\Log\LoggerInterface;
use Psy\Exception\ErrorException;
use Engage\Http\Controllers\Error\ErrorSendFormController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class MyHandler extends Handler
{
    protected $_directoryPath = "";

    public function __construct(Container $container)
    {
        parent::__construct($container);

        $this->_initLogConfig();
    }

    /**
     * エラーレベルのマッピング配列を返す(CodeIgniter形式)
     * @return array
     */
    protected function ciErrorLevelMap()
    {
        return array(
            E_ERROR           => 'Error',
            E_WARNING         => 'Warning',
            E_PARSE           => 'Parsing Error',
            E_NOTICE          => 'Notice',
            E_CORE_ERROR      => 'Core Error',
            E_CORE_WARNING    => 'Core Warning',
            E_COMPILE_ERROR   => 'Compile Error',
            E_COMPILE_WARNING => 'Compile Warning',
            E_USER_ERROR      => 'User Error',
            E_USER_WARNING    => 'User Warning',
            E_USER_NOTICE     => 'User Notice',
            E_STRICT          => 'Runtime Notice'
        );
    }

    /**
     * 例外発生時のログ出力処理
     * @param \Exception $exp
     * @throws \Exception
     */
    public function report(\Exception $exp)
    {
        if ($this->shouldntReport($exp)) {
            return;
        }

        try {
            $logger = $this->container->make(LoggerInterface::class);
        } catch (\Exception $otherExp) {
            throw $exp; // throw the original exception
        }

        $logger->error($exp, $this->_getContext($exp));
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, \Exception $exception)
    {
        $this->_directoryPath = $this->_getRouteDirectory($request);

        if ($this->_expectsJson($request)) {
            return $this->_returnJsonResponse($request, $exception);
        }

        if ($exception instanceof MyException1) {
            return $this->_renderMyException1($request, $exception);
        }
        if ($exception instanceof MyException2) {
            return $this->_renderMyException2($request, $exception);
        }
        if ($exception instanceof MyException5) {
            return $this->_renderMyException5($request, $exception);
        }
        if ($exception instanceof MyException6) {
            return $this->_renderMyException6($request, $exception);
        }
        if ($exception instanceof MyException401) {
            return $this->_returnJsonResponse($request, $exception);
        }
        if ($exception instanceof MyException404) {
            return $this->_renderMyException404($request, $exception);
        }
        if ($exception instanceof MyExceptionDB) {
            return $this->_renderMyExceptionDB($request, $exception);
        }
        if ($exception instanceof \MyExceptionMaintenance) {
            return $this->_renderMyExceptionMaintenance($request, $exception);
        }
        if ($exception instanceof NotFoundHttpException) {
            return response()->view('engage.errors.error404', [], 404);
        }
        if ((!($exception instanceof ValidationException)) && ($exception instanceof \Exception)) {
            return $this->_renderOtherException($request, $exception);
        }
        return parent::render($request, $exception);
    }

    /**
     * ログ出力関連の初期設定
     */
    protected function _initLogConfig()
    {
        // $this->_setLogPath();
        $this->_setLogFormat();
    }

    /**
     * ログ出力先の設定
     */
    protected function _setLogPath()
    {
        $monolog = \Log::getMonolog();

        //-------------------------------------------
        // デフォルトのHandlerを削除
        //-------------------------------------------
        $count = count($monolog->getHandlers());
        for($i=0; $i<$count; $i++) {
            $monolog->popHandler();
        }

        //-------------------------------------------
        // ログ出力先を設定
        // ※このタイミングで新しいHandlerが生成される
        //-------------------------------------------
        $path = config('my.app.MY_APP_LOG_PATH');
        \Log::useDailyFiles($path);
    }

    /**
     * ログの出力フォーマットを設定
     */
    protected function _setLogFormat()
    {
        $monolog = \Log::getMonolog();

        //-------------------------------------------
        // メッセージのフォーマッタをセット
        //-------------------------------------------
        $format = 'エラー時刻：%datetime% サーバー：%context.server_name% ブラウザ：%context.user_agent% IPアドレス：%context.remote_ip% Referer：%context.reffer% URL：%context.request_uri% エラー詳細：[Severity] [Message]%context.exp_message% [Filename]%context.exp_file% [Line Number]%context.exp_line% [Trace]%context.exp_trace%' . PHP_EOL;
        foreach($monolog->getHandlers() as $handler)
        {
            $formatter = new LineFormatter($format);
            $handler->setFormatter($formatter);
        }
    }

    /**
     * エラーログの追加情報
     * @param \Exception $exp
     * @return array
     */
    protected function _getContext(\Exception $exp)
    {
        $context = [];

        // WEBアクセス関連の情報
        if (\App::runningInConsole()) {
            $context['server_name'] = '';
            $context['user_agent'] = '';
            $context['remote_ip'] = '';
            $context['reffer'] = '';
            $context['request_uri'] = '';
        }
        else {
            $context['server_name'] = \Request::server('SERVER_NAME');
            $context['user_agent'] = \Request::server('HTTP_USER_AGENT');
            $context['remote_ip'] = $this->_getRemoteIp();
            $context['reffer'] = \Request::server('HTTP_REFERER');
            $context['request_uri'] = \Request::server('REQUEST_URI');
        }

        // 例外の詳細情報
        $context['exp_message'] = $exp->getMessage();
        $context['exp_file'] = $exp->getFile();
        $context['exp_line'] = $exp->getLine();
        $context['exp_trace'] = $exp->getTraceAsString();

        // エラー情報
        $context['error_severity'] = $this->_getSeverityStr($exp);

        return $context;
    }

    /**
     * アクセス元IPアドレスの取得
     * @return mixed|string
     */
    protected function _getRemoteIp()
    {
        $utils = new RequestUtils();
        return $utils->getRemoteIp();
    }

    /**
     * severityの取得(文字列で)
     * @param \Exception $exp
     * @return mixed|string
     */
    protected function _getSeverityStr(\Exception $exp)
    {
        $levels = $this->ciErrorLevelMap();
        $severity = (get_class($exp) === 'ErrorException' || $exp instanceof ErrorException) ? $exp->getSeverity() : '';
        return (!isset($levels[$severity]) ? $severity : $levels[$severity]);
    }

    /**
     * _expectsJson
     * @param $request
     * @return bool
     */
    protected function _expectsJson($request)
    {
        // todo: jsonの戻りを期待するリクエストの場合はtrueを返すようにする
        //       特定のAPI, ajax, Acceptヘッダー etc
        $path = $request->path();
        if (preg_match('(^api/works_app|^api_new/general_api)', $path)) {
            return true;
        } elseif (preg_match('(^api_new|^company/api_new|^cs/api)', $path)) {
            return true;
        }
        return false;
    }

    protected function _getRouteDirectory($request)
    {
        $path = $request->path();
        $directoryPath = "";
        if(preg_match('(^company)', $path)) {
            $directoryPath = ".company";
        }
        elseif(preg_match('(^cs)', $path)) {
            $directoryPath = ".cs";
        }
        return $directoryPath;
    }

    protected function _returnJsonResponse($request, $exception)
    {
        $exception_info = [];
        $status_code = 500;

        if ($exception instanceof MyBaseException) {
            $exception_info = $exception->getJsonExceptionInfo();
            $status_code = $exception->getStatusCode();

        } elseif ($exception instanceof NotFoundHttpException) {
            $exception_info = [
                'code' => 'PAGE_NOT_FOUND',
                'message' => '指定されたページは存在しません。',
                'data' => [],
            ];
            $status_code = 404;

        } elseif ($exception instanceof ValidationException) {
            $exception_info = [
                'code' => 'VALIDATION_ERROR',
                'message' => 'リクエストが不正です。',
                'data' => $exception->errors()
            ];
            $status_code = 400;

        } else {
            $exception_info = [
                'code' => 'INTERNAL_SERVER_ERROR',
                'message' => 'サーバー側でエラーが発生しました。',
                'data' => []
            ];
            $status_code = 500;
        }

        if (empty(array_get($exception_info, 'data'))) {
            $exception_info['data'] = (object)null;
        }
        $error = ['error' => $exception_info];
        return response()->json($error, $status_code);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyException1  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyException1($request, MyException1 $exception)
    {
        return response()->view('engage.errors'.$this->_directoryPath.'.error1', [], 404);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyException2  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyException2($request, MyException2 $exception)
    {
        $causeList = $exception->getCauseList();
        return response()->view('engage.errors'.$this->_directoryPath.'.error2', ['validation_errors' => $causeList], 404);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyException5  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyException5($request, MyException5 $exception)
    {
        $causeList = $exception->getCauseList();
        return response()->view('engage.errors'.$this->_directoryPath.'.error5', ['validation_errors' => $causeList], 404);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyException6  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyException6($request, MyException6 $exception)
    {
        return response()->view('engage.errors'.$this->_directoryPath.'.error6', [], 404);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyException404  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyException404($request, MyException404 $exception)
    {
        return response()->view('engage.errors.error404', [], 404);
    }

    /**
     * _renderMyException1
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyExceptionDB  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyExceptionDB($request, MyExceptionDB $exception)
    {
        return response()->view('engage.errors'.$this->_directoryPath.'.error_database', [], 404);
    }

    /**
     * _renderMyExceptionMaintenance
     * @param  \Illuminate\Http\Request  $request
     * @param  \MyExceptionDB  $exception
     * @return \Illuminate\Http\Response
     */
    protected function _renderMyExceptionMaintenance($request, MyExceptionMaintenance $exception)
    {
        return response()->view('engage.errors.maintenance', [], 503);
    }

    /**
     * ほかで処理されなかったエラー。エラー報告フォームを表示する。
     * @param $request
     * @param \Exception $exception
     */
    protected function _renderOtherException($request, \Exception $exception)
    {
        $controller = app()->make(ErrorSendFormController::class);
        $errorContext = $this->_getContext($exception);
        if($this->_directoryPath == ".company") {
            return $controller->companyForm($request, $errorContext);
        }
        elseif($this->_directoryPath == ".cs") {
            return $controller->csForm($request, $errorContext);
        }
        //return $controller->form($request, $errorContext); // ユーザー用
        return response()->view('engage.errors.error404', [], 404);
    }
}