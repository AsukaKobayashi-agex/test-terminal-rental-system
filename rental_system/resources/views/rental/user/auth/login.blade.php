@extends('rental.user.common.auth_base')
@section('content')

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block dflex align-items-baseline w-100 h-100">
                  <img class="h-100 w-100" src="/bootsample/img/smartphone.jfif" >
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">ようこそ !</h1>
                  </div>
                    @if(count($errors) > 0)
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <form class="user" action="{{ route('user.login') }}" method="post">
                        @csrf
                        <div class="form-group">
                          <input type="email" name="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="E-mailアドレスを入力">
                        </div>
                        <div class="form-group">
                          <input type="password" name="password" class="form-control form-control-user" id="password" placeholder="パスワード">
                        </div>
                        <div class="form-group">
                          <div class="custom-control custom-checkbox small">
                            <input type="checkbox" class="custom-control-input" id="customCheck">
                            <label class="custom-control-label" for="customCheck">ログイン情報を記憶する</label>
                          </div>
                        </div>
                        <input type="submit" value="ログイン" class="btn btn-primary btn-user btn-block" >
                        <hr>
                    </form>
                  <!--<div class="text-center">
                    <a class="small" href="forgot_password.php">パスワードを再発行</a>
                  </div>-->
                  <div class="text-center">
                    <a class="small" href="/sign-up">アカウント作成</a>
                  </div>
                </div>
                  @component('rental.user.common.footer')
                  @endcomponent
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

@endsection
