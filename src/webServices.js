import axios from 'axios';

export default class WebServices {
  _baseUrl = "http://localhost/";

  efetuarCadastro(parametros) {
    return axios.post(`${this._baseUrl}cadastro.php`, parametros);
  }

  acessar(parametros) {
    return axios.post(`${this._baseUrl}acessar.php`, parametros);
  }

  salvarPontos(parametros) {
    return axios.post(`${this._baseUrl}salvarpontos.php`, parametros);
  }

  criarPartida(parametros) {
    return axios.post(`${this._baseUrl}criapartida.php`, parametros);
  }
}