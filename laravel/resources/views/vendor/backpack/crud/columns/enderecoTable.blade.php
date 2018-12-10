{{-- enderecoTable --}} 
<?php $endereco_obj  = (object) json_decode($entry['endereco'], true); ?>
<span><?php echo $endereco_obj->value; ?></span>

