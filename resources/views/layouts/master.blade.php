@include('components.header')

<div class="wrapper" id="app">
    @include('components.navbar')

    @include('components.main-sidebar')
    <div class="content-wrapper">
        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
            <router-view></router-view>
        </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->

    </div>

      <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
@include('components.footer')
