<?php

protected $middleware = [
    \App\Http\Middleware\TrustProxies::class,  // Adicione esta linha
    // Outros middlewares...
];

?>
