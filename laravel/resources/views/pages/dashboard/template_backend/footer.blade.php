</div>
</div>

<!-- General JS Scripts -->
@include('components.script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{asset('assets/backend/js/stisla.js')}}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{asset('assets/backend/js/scripts.js')}}"></script>
<script src="{{asset('assets/backend/js/custom.js')}}"></script>
<script src="{{asset('assets/backend/js/select2.full.min.js')}}"></script>
<script src="{{ asset('assets/backend/js/page/components-chat-box.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@if (session("success"))
    <script>
        swal("System Says", "{{ session("success") }}", "success");
    </script>
@endif

@if (session("error"))
    <script>
        swal("System Says", "{{ session("error") }}", "error");
    </script>
@endif

@yield('script')

<!-- Page Specific JS File -->
</body>
</html>
