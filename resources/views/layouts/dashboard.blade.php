<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TerraCobro | @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/logos/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}" />

    <!-- Sweat alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.27/dist/sweetalert2.min.css" rel="stylesheet">

    <!-- Jquery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

    <!-- DataTable -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"></script>

    <!-- DATA-TABLES CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.js"></script>

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    @yield('afterCss')

</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!-- Sidebar Start -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div>
                <div class="brand-logo d-flex align-items-center justify-content-center mt-2">
                    <a href="{{ route('dashboard') }}" class="text-nowrap logo-img">
                        <img src="{{ asset('images/logos/land.png') }}" width="100" alt="Logo sistema" />
                    </a>
                    <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                        <i class="ti ti-x fs-8"></i>
                    </div>
                </div>
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav scroll-sidebar" data-simplebar="" id="boundary-element">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Home</span>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link" href="/dashboard" aria-expanded="false">
                                <span>
                                    <i class="ti ti-layout-dashboard"></i>
                                </span>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-small-cap">
                            <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                            <span class="hide-menu">Menu</span>
                        </li>

                        
                        @role('admin')




                                <li class="{{ 'sidebar-item' }}">
                                    <a class="sidebar-link" href="/propiedades">
                                        <span>
                                            <i class="fa-solid fa-kaaba" style="font-size: 20px;"></i>
                                        </span>
                                        <span class="hide-menu">Propiedades</span>
                                    </a>
                                </li>
                                
                   
                                <li class="{{ 'sidebar-item' }}">
                                    <a class="sidebar-link" href="/clientes">
                                        <span>
                                            <i class="fa-solid fa-users" style="font-size: 20px;"></i>
                                        </span>
                                        <span class="hide-menu">Clientes</span>
                                    </a>
                                </li>



                         


                                <li class="{{ 'sidebar-item' }}">
                                    <a class="sidebar-link" href="/financiamientos">
                                        <span>
                                            <i class="fa-solid fa-briefcase" style="font-size: 20px;"></i>
                                     
                                        </span>
                                        <span class="hide-menu">Financiamientos</span>
                                    </a>
                                </li>



                                <li class="{{ 'sidebar-item' }}">
                                    <a class="sidebar-link" href="/pagos">
                                        <span>
                                     <i class="fa-solid fa-money-check-dollar" style="font-size: 20px;"></i>
                               
                                        </span>
                                        <span class="hide-menu">Pagos</span>
                                    </a>
                                </li>

                                @endrole



                                @role('invitado')

                                <li class="{{ 'sidebar-item' }}">
                                    <a class="sidebar-link" href="/pagos">
                                        <span>
                                     <i class="fa-solid fa-money-check-dollar" style="font-size: 20px;"></i>
                               
                                        </span>
                                        <span class="hide-menu">Pagos</span>
                                    </a>
                                </li>
                                
                                @endrole
                         
                         
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <!--  Header Start -->
            <header class="app-header">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav">
                        <li class="nav-item d-block d-xl-none">
                            <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse"
                                href="javascript:void(0)">
                                <i class="ti ti-menu-2"></i>
                            </a>
                        </li>
                        <li class="nav-item d-none d-xl-block">
                            <h3>Proyecto Agricola El Jobo</h3>
                        </li>
                    </ul>
                    <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                        <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                            <li class="nav-item">
                                {{ Auth::user()->name }}
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <img src="{{ asset('images/profile/user-1.jpg') }}" alt="" width="35"
                                        height="35" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up"
                                    aria-labelledby="drop2">
                                    <div class="message-body text-center">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <input type="submit" value="Cerrar sesión"
                                                class="btn btn-danger mx-auto mt-2 d-block">
                                        </form>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
            <!--  Header End -->
            <div style="padding:20px;padding-top: 80px;">
                @yield('contenido')
            </div>
        </div>
    </div>



    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/sidebarmenu.js') }}"></script>
    <script src="{{ asset('js/app.min.js') }}"></script>
    <script src="{{ asset('libs/simplebar/dist/simplebar.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#miTabla').DataTable({
                "paging": true,
                "ordering": true,
                "searching": true,
                "info": true,
                "lengthMenu": [5, 10, 25, 50, 100],
                "pageLength": 5,
                "language": {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros por página",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    }
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.custom-dropdown').on('show.bs.dropdown', function() {
                // Calcula la altura del menú desplegable
                var dropdownHeight = $(this).find('.dropdown-menu').outerHeight();

                // Ajusta el margen superior del contenido debajo del menú
                $(this).next().css('margin-top', dropdownHeight + 'px');
            });

            $('.custom-dropdown').on('hide.bs.dropdown', function() {
                // Restaura el margen superior del contenido
                $(this).next().css('margin-top', '0');
            });
        });
    </script>

    <script>
        const AlertMessage = (mensaje, tipo) => {
            Swal.fire({
                title: tipo === 'success' ? 'Éxito' : 'Error',
                text: mensaje,
                icon: tipo,
                toast: true,
                position: 'top-end', // Puedes ajustar la posición según tus preferencias
                showConfirmButton: false,
                timer: 3000 // Controla la duración de la notificación en milisegundos (en este caso, 3 segundos)
            });
        }

        // Aquí escuchamos la respuesta JSON del controlador
        @if (session('success'))
            AlertMessage('{{ session('success') }}', 'success');
        @endif

        @if (session('error'))
            AlertMessage('{{ session('error') }}', 'error');
            console.log('{{ session('error') }}');
        @endif

        function confirmDelete(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Si el usuario confirma, envía el formulario de eliminación correspondiente
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        }

    </script>



    @yield('AfterScript')


</body>

</html>
