<!DOCTYPE html>
<html lang="ja">

@component('rental.user.common.header')
@endcomponent

<body class="bg-gradient-primary">

  <div class="container">
      @section('content')
      @show
  </div>

  @component('rental.user.common.corescript')
  @endcomponent


  @stack('scripts')

</body>

</html>
