<ol class="pager">
	<?php if($_['page']>0):?>
	<li class="pagerbutton1"><a href="<?php print_unescaped($_['url'].($_['page']-1));?>"><?php p($l->t( 'prev' )); ?></a></li>
	<?php endif; ?>
	<?php if ($_['pagestart']>0):?>
	&hellip;
	<?php endif;?>
	<?php for ($i=$_['pagestart']; $i < $_['pagestop'];$i++):?>
		<?php if ($_['page']!=$i):?>
		<li><a href="<?php print_unescaped($_['url'].$i);?>"><?php p($i+1);?></a></li>
		<?php else:?>
		<li><?php p($i+1);?></li>
		<?php endif?>
	<?php endfor;?>
	<?php if ($_['pagestop']<$_['pagecount']):?>
	&hellip;
	<?php endif;?>

	<?php if(($_['page']+1)<$_['pagecount']):?>
	<li class="pagerbutton2"><a href="<?php print_unescaped($_['url'].($_['page']+1));?>"><?php p($l->t( 'next' )); ?></a></li>
	<?php endif; ?>
</ol>
