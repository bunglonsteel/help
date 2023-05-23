<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Error</title>
	<link rel="stylesheet" href="<?= config_item('base_url'); ?>public/assets/front/style.css">
</head>

<body>
	<main class="flex items-center h-screen p-16 dark:bg-gray-900 dark:text-gray-100">
		<div class="container flex flex-col items-center justify-center px-5 m-auto">
			<div class="max-w-md text-center">
				<p class="text-2xl font-semibold md:text-3xl"><?= $heading; ?> 😟 </p>
				<p class="mt-4 mb-8 dark:text-gray-400"><?= $message; ?></p>
				<a rel="noopener noreferrer" href="<?= config_item('base_url'); ?>" class="px-8 py-3 font-semibold rounded dark:bg-violet-400 dark:text-gray-900">Back to homepage</a>
			</div>
		</div>
	</main>
</body>

</html>