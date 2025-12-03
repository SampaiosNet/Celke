@if (session('success_sweetAlert'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Pronto!",
                text: "{{ session('success_sweetAlert') }}",
                icon: "success"
            });
        });
    </script>
@endif   
@if (session('success'))
    <div class="alert-success">{{ session('success') }}</div>      
@endif 

@if (session('error_sweetAlert'))
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            Swal.fire({
                title: "Erro!",
                text: "{{ session('error_sweetAlert') }}",
                icon: "error"
            });
        });
    </script>
@endif
@if (session('error'))
    <div class="alert-error">{{ session('error') }}</div>      
@endif

@if ($errors->any())
    @php
        $alertMode = env('ALERT_MODE', '');
        $msgError = '';

        foreach ($errors->all() as $error) 
        {
            $msgError .= $error . '<br>';
        }
    @endphp

    {{-- @foreach ($errors->all() as $error)
        {{ $error }} <br>
    @endforeach --}}
    
    @if ($alertMode === '')
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                Swal.fire({
                    title: 'Erro',
                    html: '{!! $msgError !!}',
                    icon: 'error'
                });
            });
        </script>
    @else
        <div class="alert-error">
            {!! $msgError !!}
        </div>
    @endif
@endif