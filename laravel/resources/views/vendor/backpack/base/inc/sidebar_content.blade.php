<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->

<li class="header">ADMINISTRAÇÃO</li>
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i> <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>



<li><a href="{{ backpack_url('funcionarios') }}"><i class='fa fa-briefcase'></i> <span>Funcionários</span></a></li>


<li class="header">ENFERMAGEM</li>
<li><a href="{{ backpack_url('doenca') }}"><i class='fa fa-archive'></i> <span>Doenças</span></a></li>

<li class="header">CONFIGURAÇÕES</li>
<li class="treeview">
    <a href="#"><i class="fa fa-gear"></i> <span>Sistema</span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
        <li>
            <li><a href="{{ backpack_url('tipo_funcionario') }}"><i class='fa fa-user'></i> <span>Tipos de Funcionários</span></a></li>
            <li><a href="{{ backpack_url('tipo_situacao') }}"><i class='fa fa-book'></i> <span>Tipos de Situações</span></a></li>
        </li>
    </ul>
</li>

<!-- Users, Roles Permissions -->
<li class="treeview">
    <a href="#"><i class="fa fa-group"></i> <span>Usuários  </span> <i class="fa fa-angle-left pull-right"></i></a>
    <ul class="treeview-menu">
      <li><a href="{{ backpack_url('user') }}"><i class="fa fa-user"></i> <span>Usuários</span></a></li>
      <li><a href="{{ backpack_url('role') }}"><i class="fa fa-group"></i> <span>Papéis</span></a></li>
      <li><a href="{{ backpack_url('permission') }}"><i class="fa fa-key"></i> <span>Permissões</span></a></li>
    </ul>
  </li>