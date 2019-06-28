<?php

namespace MyCommon\Libraries\ExternalApps\Jenkins;

class JenkinsManage
{
	const TIMER_TRIGGER = '{TimerTrigger}';
	const BATCH_FILE = '{BatchFile}';
	const TEMPLATE_XML = '/Packages/MyCommon/Libraries/ExternalApps/Jenkins/config-expected.xml';

	/**
	 * @var string xml for Hudson - API (REST)
	 */
	protected $_xml;

	/**
	 * @var string $baseUrl Hudson url
	 */
	public $baseUrl;

	/**
	 * Log name
	 *
	 * @var string
	 */
	protected $_log;

	/**
	 * Log File
	 *
	 * @var file
	 */
	protected $_logFile;

	/**
	 * Logging 
	 * @var bool
	 */
	protected $_logging;

	/**
	 * ログイン認証用のクッキーパス
	 * @var type
	 */
	protected $_cookie;

	// ------------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * [AGEX用にカスタマイズ]
	 * ・$loggingの初期値をFALSE
	 * ・ログイン認証を通しておく
	 *
	 * @param string $baseUrl Base url of Hudson
	 * http://localhost:8080/ in standalone mode
	 * @param bool $logging log in file default is true
	 * @return void
	 */
	public function __construct ()
	{
		if (! extension_loaded('curl')) {
			throw new \Exception('Extension CURL not loaded!');
			exit();
		}

		$this->_logging = config('my.jenkins.BAT_SCHEDULER_LOG');
		$this->baseUrl = config('my.jenkins.BAT_SCHEDULER_HOST');

		/**
		 * 認証を通す
		 */
		//URLを指定する
		$loginUrl = $this->baseUrl . 'j_acegi_security_check';
		//テンポラリファイルを作成する
		$this->_cookie = tempnam(sys_get_temp_dir(),'cookie_');

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $loginUrl);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$postArray = array(
			// ログインID
			'j_username=' . urlencode(config('my.jenkins.BAT_SCHEDULER_ID')),
			// ログインIDのパスワード
			'j_password=' . urlencode(config('my.jenkins.BAT_SCHEDULER_PASSWORD'))
		);
		curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $postArray));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//クッキーを書き込むファイルを指定
		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookie);

		curl_exec($ch);
		curl_close($ch);

		// debug
//		$text = file_get_contents($this->_cookie);
//		echo $text;
//		exit;

		// logging
		if ($this->_logging) {
			$this->_log = "error-hudson.log";
			$this->_logFile = fopen($this->_log, 'a+');
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Destruct
	 *
	 */
	public function __destruct ()
	{
		if ($this->_logFile) {
			fclose($this->_logFile);
		}

		//クッキーを書き込むファイルを削除
		unlink($this->_cookie);
	}

	// ------------------------------------------------------------------------

	/**
	 * Post by curl to url config.xml
	 * @access protected
	 * @param string $url URL to post
	 * @param string $config xml hudson config
	 * @return bool
	 */
	protected function _postCurl ($url, $config)
	{
		/**
		 * 処理の実行
		 */
		// jenkinsユーザーのIDとAPITOKEN
		// 認証がある場合（開発サーバ、テストサーバ、本サーバ）は、認証を設定する。
//		$userpwd = BAT_SCHEDULER_ID . ':' . BAT_SCHEDULER_APITOKEN;

		if (! empty($config)) {
			// custom header
			$header[] = "Content-Type:application/xml";
			//$header[] = "Content-length: " . strlen($config) . "\r\n";
			//$header[] = $config;

		}
		// init curl
		$ch = curl_init();
		if ($this->_logging) {
			curl_setopt($ch, CURLOPT_VERBOSE, 1);
		}
		if ($this->_logFile && $this->_logging) {
			curl_setopt($ch, CURLOPT_STDERR, $this->_logFile);
		}
		// URL to post to
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		// return into a variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		// 認証
//		if (!empty($userpwd)) {
//			curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
//		}
		// 認証用のクッキーを読み込むファイルを指定
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookie);
		// custom headers, see above
		if (! empty($config)) {
			curl_setopt($ch, CURLOPT_HEADER, 1);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
			// This POST is special, and uses its specified Content-type
			//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $config);
		} else {
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
		}

		//php5.6アップデート対策 refs http://php.net/manual/ja/function.curl-setopt.php
		//	5.6からCURLOPT_SAFE_UPLOADの値のデフォルト値がTRUEになった
//		curl_setopt($ch, CURLOPT_SAFE_UPLOAD, FALSE);

		//run!
		$http_result = curl_exec($ch);
		$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);

//		preDump($status, TRUE);
		// result return 200, 302 for OK, 400, 500 for BAD
		if ($status == 200 || $status == 302) {
			return true;
		} else {
			return false;
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * get Last Revision
	 * @param string job url
	 * @return string
	 */
	public function getLastRevision ($url)
	{
		$this->xml = simplexml_load_file($url . 'lastSuccessfulBuild/api/xml');
		return $this->xml->changeSet->revision->revision;
	}

	// ------------------------------------------------------------------------

	/**
	 * Create job
	 *
	 * @return bool
	 */
	public function createJob ($timestamp, $command, $newJobName)
	{
		// テンプレートXMLの読み込み
		$filePath = base_path() . self::TEMPLATE_XML;
		$templateConfig = file_get_contents( $filePath);

		$month	= date('m', $timestamp);
		$day	= date('d', $timestamp);
		$hour	= date('H', $timestamp);
		$min	= date('i', $timestamp);

		// スケジュール(cron形式)の設定
		$config = str_replace(self::TIMER_TRIGGER, "{$min} {$hour} {$day} {$month} *", $templateConfig);
		$config = str_replace(self::BATCH_FILE, $command, $config);
		return $this->_createJob($newJobName, $config);
	}

	// ------------------------------------------------------------------------

	/**
	 * Create job by REST $baseUrl.'createItem?name=$newJobName'
	 * @param string $newJobName new JobName
	 * @param string $config xml config file
	 * @return bool
	 */
	protected function _createJob ($newJobName, $config)
	{
		return $this->_postCurl($this->baseUrl . 'createItem?name=' . $newJobName, $config);
	}

	// ------------------------------------------------------------------------

	/**
	 * Copy job
	 *
	 * $baseUrl.'createItem?name=$newJobName&mode=copyJob&from=$fromJobName'
	 *
	 * @param string $newJobName new JobName
	 * @param string $fromJobName from JobName
	 * @param string $config xml config file
	 * @return bool
	 */
	public function copyJob ($newJobName, $fromJobName, $config)
	{
		return $this->_postCurl($this->baseUrl . 'createItem?name=' . $newJobName . '&mode=copyJob&from=' . $fromJobName, $config);
	}

	// ------------------------------------------------------------------------

	/**
	 * Restart hudson
	 * $baseUrl.'restart'
	 */
	public function restartHudson ()
	{
		return $this->_postCurl($this->baseUrl.'restart', null);
	}

	// ------------------------------------------------------------------------

	/**
	 * get Config
	 *
	 * [AGEX用にカスタマイズ]
	 * クッキーファイルを参照するためにfile_get_contentsから
	 * curlにconfigファイルの取得方法を変更。
	 *
	 * @param $url job url
	 * @return string config.xml
	 */
	public function getConfig ($url)
	{
		//URLを指定する
		$url = $url . "/config.xml";
		//クッキー情報の入ったファイルへのパス
		//cURLを初期化して使用可能にする
		$curl = curl_init();
		//オプションにURLを設定する
		curl_setopt($curl, CURLOPT_URL, $url);
		//クッキーを読み込むファイルを指定
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->_cookie);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		//php5.6アップデート対策 refs http://php.net/manual/ja/function.curl-setopt.php
		//	5.6からCURLOPT_SAFE_UPLOADの値のデフォルト値がTRUEになった
//		curl_setopt($curl, CURLOPT_SAFE_UPLOAD, FALSE);

		//URLにアクセスし、結果を表示させる
		$config = curl_exec($curl);
		//cURLのリソースを解放する
		curl_close($curl);

		return $config;
	}

	// ------------------------------------------------------------------------

	/**
	 * Update job
	 * by POST to same url as getConfig
	 * @param string $url
	 * @param string $config file with config
	 */
	public function updateConfig ($url, $config)
	{
		return $this->_postCurl($url.'config.xml', $config);
	}

	// ------------------------------------------------------------------------

	/**
	 * get Jobs List
	 * @param string $select null (names), url
	 * @return array
	 */
	public function getJobsList ($select = null)
	{
		//URLを指定する
		$url = $this->baseUrl . 'api/xml';
		//クッキー情報の入ったファイルへのパス
		//cURLを初期化して使用可能にする
		$curl = curl_init();
		//オプションにURLを設定する
		curl_setopt($curl, CURLOPT_URL, $url);
		//クッキーを読み込むファイルを指定
		curl_setopt($curl, CURLOPT_COOKIEFILE, $this->_cookie);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

		//php5.6アップデート対策 refs http://php.net/manual/ja/function.curl-setopt.php
		//	5.6からCURLOPT_SAFE_UPLOADの値のデフォルト値がTRUEになった
//		curl_setopt($curl, CURLOPT_SAFE_UPLOAD, FALSE);

		//URLにアクセスし、結果を表示させる
		$config = curl_exec($curl);
		//cURLのリソースを解放する
		curl_close($curl);

		$this->_xml = simplexml_load_string($config);
		foreach ($this->_xml->job as $i) {
			if (is_null($select)) {
				$jobs[] = $i->name;
			} elseif ($select == "url") {
				$jobs[] = $i->url;
			} elseif ($select == "both") {
				$jobs[] = array("name" => $i->name , "url" => $i->url);
			} elseif ($select == "all") {
				$jobs[] = $i;
			}
		}
		return $jobs;
	}

	// ------------------------------------------------------------------------

	/**
	 * get All Jobs Configs
	 * @param string $dir output directory
	 * @return void
	 */
	public function getAllConfigs ($dir = null)
	{
		$jobs = $this->getJobsList("both");
		foreach ($jobs as $job) {
			$file = str_replace(" ", "_", $job["name"]);
			is_null($dir) ? $filename = $file : $filename = $dir . $file;
			$config = $this->getConfig($job["url"]);
			file_put_contents($filename . "-config.xml", $config);
		}
	}

	// ------------------------------------------------------------------------

    /**
     * Delete job
     * @param $jobName
     * @return bool
     */
	public function deleteJob ($jobName)
	{
	    $url = $this->baseUrl . "job/{$jobName}/";
		$config = $this->getConfig($url);
		return $this->_postCurl($url . 'doDelete', $config);
	}

	// ------------------------------------------------------------------------

    /**
     * Disable job
     * @param $jobName
     * @return bool
     */
	public function disableJob ($jobName)
	{
		if (empty($jobName)) {
			return false;
		}
		$url = $this->baseUrl . "job/{$jobName}/";
		$config = $this->getConfig($url);
		return $this->_postCurl($url.'disable', $config);
	}

	// ------------------------------------------------------------------------

    /**
     * Enable job
     * @param $url
     * @return bool
     */
	public function enableJob ($url)
	{
		return $this->_postCurl($url.'enable', null);
	}

	// ------------------------------------------------------------------------

    /**
     * Build job
     * @param $url
     * @return bool
     */
	public function buildJobs ($url)
	{
		return $this->_postCurl($url.'build', null);
	}

	// ------------------------------------------------------------------------

	/**
	 * getJobDateTime
	 * 
	 * @param string $url
	 */
	public function getJobDateTime ($url)
	{
		$xml = $this->getConfig($url);
		$xml = new SimpleXMLElement($xml);

		if (!isset($xml->triggers->{'hudson.triggers.TimerTrigger'}->spec)) {
			return FALSE;
		}
		$dateList = (string)$xml->triggers->{'hudson.triggers.TimerTrigger'}->spec;
		$dateArray = explode(' ', $dateList);

		// 書式が不正な場合はFALSE
		if (count($dateArray) < 5) {
			return FALSE;
		}

		// * が混ざっている場合は、固定のスケジュールのため除外
		if ($dateArray[0] == '*' ||
			$dateArray[1] == '*' ||
			$dateArray[2] == '*' ||
			$dateArray[3] == '*') {
			return FALSE;
		}

		// 年(Jenkinsでは年を扱うことができないため、2013年固定にする)
		$year	= 2013;
		// 分
		$min	= sprintf('%02d', $dateArray[0]);
		// 時
		$hour	= sprintf('%02d', $dateArray[1]);
		// 日
		$day	= sprintf('%02d', $dateArray[2]);
		// 月
		$month	= sprintf('%02d', $dateArray[3]);

		return "{$year}/{$month}/{$day} {$hour}:{$min}:00";
	}

	// ------------------------------------------------------------------------
}





