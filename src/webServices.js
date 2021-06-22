import axios from 'axios';

export default class WebServices {
    _baseUrl = "http://localhost/";

    efetuarCadastro(parametros) {
        console.log('Efetuar cadastro', parametros);
        return axios.post(`${this._baseUrl}cadastro.php`, parametros);
    }
}