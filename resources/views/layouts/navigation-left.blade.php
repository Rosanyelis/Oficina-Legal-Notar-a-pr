        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="{{ route('dashboard') }}" class="app-brand-link">
                    <span class="app-brand-logo demo">
                        <span style="color: var(--bs-primary)">
                            <img src="{{ asset('assets/img/logo.png') }}" width="50"  alt="" >
                        </span>
                    </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
                        fill-opacity="0.9" />
                        <path
                        d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
                        fill-opacity="0.4" />
                    </svg>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <li class="menu-item @if (Route::currentRouteName() == 'dashboard') active @endif">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-home-smile-line"></i>
                        <div data-i18n="Dashboard">Dashboard</div>
                    </a>
                </li>

                <li class="menu-item
                    @if (Route::currentRouteName() == 'clientes.index' ||
                        Route::currentRouteName() == 'clientes.create' ||
                        Route::currentRouteName() == 'clientes.edit')
                        active
                    @endif">
                    <a href="{{ route('clientes.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-group-2-fill"></i>
                        <div data-i18n="Clientes">Clientes</div>
                    </a>
                </li>

                <li class="menu-item
                    @if (Route::currentRouteName() == 'gestiones.index' ||
                        Route::currentRouteName() == 'gestiones.create' ||
                        Route::currentRouteName() == 'gestiones.edit')
                        active
                    @endif">
                    <a href="{{ route('gestiones.index') }}" class="menu-link">
                        <i class="menu-icon tf-icons ri-kanban-view"></i>
                        <div data-i18n="Gestiones Kamban">Gestiones Kamban</div>
                    </a>
                </li>


                <li class="menu-header mt-5">
                    <span class="menu-header-text" data-i18n="Configuraciones">Configuraciones</span>
                </li>
                <li class="menu-item
                    @if (Route::currentRouteName() == 'users.index' ||
                        Route::currentRouteName() == 'users.create' ||
                        Route::currentRouteName() == 'users.edit' ||
                        Route::currentRouteName() == 'juzgado.index' ||
                        Route::currentRouteName() == 'juzgado.create' ||
                        Route::currentRouteName() == 'juzgado.edit' ||
                        Route::currentRouteName() == 'materias.index' ||
                        Route::currentRouteName() == 'materias.create' ||
                        Route::currentRouteName() == 'materias.edit' ||
                        Route::currentRouteName() == 'medios-contacto.index' ||
                        Route::currentRouteName() == 'medios-contacto.create' ||
                        Route::currentRouteName() == 'medios-contacto.edit')
                        active open
                    @endif">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons ri-settings-2-fill"></i>
                        <div data-i18n="Configuraciones">Configuraciones</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'juzgado.index' ||
                                Route::currentRouteName() == 'juzgado.create' ||
                                Route::currentRouteName() == 'juzgado.edit')
                                active
                            @endif">
                            <a href="{{ route('juzgado.index') }}" class="menu-link">
                                <div data-i18n="Juzgados">Juzgados</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'materias.index' ||
                                Route::currentRouteName() == 'materias.create' ||
                                Route::currentRouteName() == 'materias.edit')
                                active
                            @endif">
                            <a href="{{ route('materias.index') }}" class="menu-link">
                                <div data-i18n="Materias">Materias</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'medios-contacto.index' ||
                                Route::currentRouteName() == 'medios-contacto.create' ||
                                Route::currentRouteName() == 'medios-contacto.edit')
                                active
                            @endif">
                            <a href="{{ route('medios-contacto.index') }}" class="menu-link">
                                <div data-i18n="Medios de Contacto">Medios de Contacto</div>
                            </a>
                        </li>
                        <li class="menu-item
                            @if (Route::currentRouteName() == 'users.index' ||
                                Route::currentRouteName() == 'users.create' ||
                                Route::currentRouteName() == 'users.edit') active @endif">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <div data-i18n="Usuarios">Usuarios</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
