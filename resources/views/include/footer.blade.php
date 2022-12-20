<script src="https://cdnjs.cloudflare.com/ajax/libs/react/0.14.2/react.js"></script>
{{-- <script src="{{ mix('js/app.js') }}"></script> --}}
<script src="{{ mix('js/library.js') }}"></script>

@if (strstr(url()->current(), 'admin'))
    <script src="{{ mix('js/admin.js') }}"></script>
    {{-- <script src="/js/anim_button.js"></script>	 --}}
    {{-- <script src="/js/script.js"></script> --}}
    {{-- <script src="/js/intlTelInput.js"></script> --}}
@else
    <script src="{{ mix('js/user.js') }}"></script>
    @include('include.script-user-footer')
@endif


</body>
</html>