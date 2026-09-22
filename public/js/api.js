const CitaSaludAPI = {

    baseUrl: '/CitaSalud/public',

    getToken: function () {
        return sessionStorage.getItem('citasalud_api_token');
    },

    setToken: function (token) {
        sessionStorage.setItem('citasalud_api_token', token);
    },

    clearToken: function () {
        sessionStorage.removeItem('citasalud_api_token');
    },

    async login(email, password) {

        const response = await fetch(
            this.baseUrl + '/api/login',
            {
                method: 'POST',

                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },

                body: JSON.stringify({
                    email: email,
                    password: password
                })
            }
        );

        const data = await response.json();

        if (!response.ok || !data.success) {
            throw new Error(
                data.message || 'No fue posible iniciar sesión.'
            );
        }

        this.setToken(data.data.token);

        return data;
    },

    async getEspecialidades() {

        return this.request(
            '/api/especialidades'
        );
    },

    async getMedicos(especialidadId) {

        return this.request(
            '/api/medicos?especialidad_id=' +
            encodeURIComponent(especialidadId)
        );
    },

    async getDisponibilidad(medicoId, fecha) {

        return this.request(
            '/api/disponibilidad?medico_id=' +
            encodeURIComponent(medicoId) +
            '&fecha=' +
            encodeURIComponent(fecha)
        );
    },

    async request(endpoint, options = {}) {

        const token = this.getToken();

        if (!token) {
            throw new Error(
                'No existe un token de autenticación.'
            );
        }

        const headers = options.headers || {};

        headers['Accept'] = 'application/json';
        headers['Authorization'] = 'Bearer ' + token;

        const response = await fetch(
            this.baseUrl + endpoint,
            {
                ...options,
                headers: headers
            }
        );

        const data = await response.json();

        if (response.status === 401) {
            this.clearToken();

            throw new Error(
                'La sesión de la API ha expirado.'
            );
        }

        if (!response.ok || !data.success) {
            throw new Error(
                data.message || 'Error en la API.'
            );
        }

        return data;
    },

    async cargarMedicosPorEspecialidad(especialidadId) {

        return await CitaSaludAPI.getMedicos(
            especialidadId
        );
    },

    async cargarDisponibilidad(medicoId, fecha) {

        return await CitaSaludAPI.getDisponibilidad(
            medicoId,
            fecha
        );
    },

    async getCitas() {
        return await this.request('/api/citas');
    },

    async getDetalleCita(citaId) {

        return await this.request(
            '/api/citas/detalle?id=' +
            encodeURIComponent(citaId)
        );

    },

};