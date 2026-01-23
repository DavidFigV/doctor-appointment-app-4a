<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

// USar la función para refrescar la BD
uses(RefreshDatabase::class);

test('<Un usuario no puede eliminarse a sí mismo', function () {
    // 1) Crear un usuario de prueba
    $user = User::factory()->create();
    // 2) Simular que ese usuario ya inició sesión
    $this->actingAs($user, 'web');
    // 3) Simular una petición HTTP DELETE (borrar un usuario)

    $response = $this->delete(route('admin.users.destroy', $user));;
    // 4) Esperar que el servidor bloquee el borrado a sí mismo
    $response->assertStatus(403);
    // 5) Verificar en la BD que sigue existiendo el usuario
    $this->assertDatabaseHas('users', ['id' => $user->id]);
});
