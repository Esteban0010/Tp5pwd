<?php if ($recaptcha_api): ?><script src="<?php echo $recaptcha_api; ?>" async defer></script>
<?php endif; ?><?php if ($highlight): ?><script src="<?php echo $highlight; ?>" defer></script>
<?php endif; ?><script src="<?php echo $common; ?>" defer></script><?php foreach ($autoload_javascript as $autoload): ?><script src="<?php echo $autoload; ?>" defer></script>
<?php endforeach; ?><link rel="stylesheet" type="text/css" href="<?php echo $stylesheet; ?>"><?php foreach ($autoload_stylesheet as $autoload): ?><link rel="stylesheet" type="text/css" href="<?php echo $autoload; ?>">
<?php endforeach; ?><?php if ($custom): ?><link rel="stylesheet" type="text/css" href="<?php echo $custom; ?>">
<?php endif; ?><?php if ($site_css): ?><link rel="stylesheet" type="text/css" href="<?php echo $site_css; ?>">
<?php endif; ?>