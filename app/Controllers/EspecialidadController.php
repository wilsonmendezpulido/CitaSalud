<?php

class EspecialidadController extends Controller
{
    public function index()
    {
        require_once BASE_PATH . '/app/Models/Especialidad.php';

        $model = new Especialidad();

        $especialidades = $model->getAll();

        $this->json(array(
            'success' => true,
            'data' => $especialidades
        ));
    }
}
