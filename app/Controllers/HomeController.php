<?php

class HomeController extends Controller
{
    public function index(): void
    {
        $this->view('home/index', [
            'titulo' => 'Sistema de Gestión de Citas Médicas'
        ]);
    }
}