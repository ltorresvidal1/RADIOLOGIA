@php    
if(auth()->user()->perfile_id==1) {
echo '<div class="menu-header"><span class="menu-text">Super-Administrador</span></div>';
echo '<div class="menu-item  ">
        <a href="/principal" class="menu-link">
            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
            <span class="menu-text">Tablero de Control</span>
        </a>
    </div>';
echo '<div class="menu-item  active">
        <a href="/clientes" class="menu-link">
            <span class="menu-icon"><i class="fa fa-building"></i></span>
            <span class="menu-text">Clientes</span>
        </a>
    </div>';
echo '<div class="menu-item has-sub ">
        <a href="" class="menu-link">
            <span class="menu-icon"><i class="fa fa-user"></i></span>
            <span class="menu-text">Seguridad</span>
            <span class="menu-caret"><b class="caret"></b></span>
        </a>
        <div class="menu-submenu">
                <div class="menu-item  ">
                    <a href="/sa_usuarios" class="menu-link"><span class="menu-text">Usuarios</span></a>		
                </div>
        </div>
    </div>';
    
}
if(auth()->user()->perfile_id==2) {

echo '<div class="menu-header"><span class="menu-text">Administrador</span></div>
                    <div class="menu-item">
                        <a href="/medicos" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-user-md"></i></span>
                            <span class="menu-text">Radiologos</span>	
                        </a>
                    </div>
                    <div class="menu-item">
                        <a href="/usuarios" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-users"></i></span>
                            <span class="menu-text">Usuarios</span>	
                        </a>
                    </div>
                    <div class="menu-item  ">
                        <a href="/plantillas" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-list-alt"></i></span>
                            <span class="menu-text">Plantillas</span>
                        </a>
                    </div>

                <div class="menu-header"><span class="menu-text">Asistencial</span></div>
                    <div class="menu-item  ">
                        <a href="/principal" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Tablero de Control</span>		
                        </a>
                    </div>
                    <div class="menu-item  ">
                        <a href="/estudios" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-tasks"></i></span>
                            <span class="menu-text">Estudios</span>
                        </a>
                    </div>
                    <div class="menu-item  ">
                        <a href="/informes" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-caret-right"></i></span>
                            <span class="menu-text">Informes</span>	
                        </a>
                    </div>';
}

if(auth()->user()->perfile_id==3) {
    echo '		<div class="menu-header"><span class="menu-text">Radiologo</span></div>
                    <div class="menu-item  ">
                        <a href="/principal" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-laptop"></i></span>
                            <span class="menu-text">Tablero de Control</span>		
                        </a>
                    </div>
                    <div class="menu-item  ">
                        <a href="/estudios" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-tasks"></i></span>
                            <span class="menu-text">Estudios</span>
                        </a>
                    </div>
                    <div class="menu-item  ">
                        <a href="/informes" class="menu-link">
                            <span class="menu-icon"><i class="fa fa-caret-right"></i></span>
                            <span class="menu-text">Informes</span>	
                        </a>
                    </div>';
}
@endphp