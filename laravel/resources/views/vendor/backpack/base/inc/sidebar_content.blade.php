<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="header">ADMINISTRAÇÃO</li>
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>


<li><a href="{{ backpack_url('tipo_funcionario') }}"><i class='fa fa-link'></i> <span>Tipos de Funcionários</span></a></li>


<li class="header">ENFERMAGEM</li>
<li><a href="{{ backpack_url('doenca') }}"><i class='fa fa-link'></i> <span>Doenças</span></a></li>

<li class="treeview">
    <a href="#"><i class="fa fa-key"></i> <span>Roles & Permissions</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/role') }}"><span>Roles</span></a>
        </li>
        <li>
            <a href="{{ url(config('backpack.base.route_prefix', 'admin') . '/permission') }}"><span>Permissions</span></a>
        </li>
    </ul>
</li>