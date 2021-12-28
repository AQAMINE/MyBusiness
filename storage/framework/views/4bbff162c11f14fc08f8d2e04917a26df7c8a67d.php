<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 Error: Not Found</title>
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/errors.css')); ?>" rel="stylesheet">

</head>

<body>
    <main class="bsod container">
        <h1 class="neg title"><span class="bg">Error - 404</span></h1>
        <p>An error has occured, to continue:</p>
        <p>* Return to our homepage.<br />
        * Send us an e-mail about this error and try later.</p>
        <nav class="nav">
          <a href="<?php echo e(route('home')); ?>" class="link">Home Page</a>&nbsp;|&nbsp;<a href="mailto: aqebliamine1@gmail.com" class="link">Contact US</a>
        </nav>
      </main>
      </main>

      <script src="<?php echo e(asset('js/errors.js')); ?>" defer></script>
</body>
</html>
<?php /**PATH /Users/aqamine/Desktop/MyBusiness/resources/views/errors/404.blade.php ENDPATH**/ ?>