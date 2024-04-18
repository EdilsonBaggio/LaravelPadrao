
@extends('layout.master') 
@section('content')
<div class="container">
  <h2 class="titulo">Tabela de Cadastros:</h2>      
  <table class="table">
    <thead>
      <tr>
        <th>Nome:</th>
        <th>Email:</th>
        <th>CPF:</th>
        <th>Telefone:</th>
        <th>Data de Nascimento:</th>
        <th>Ações:</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>João da Silva</td>
        <td>joao@example.com</td>
        <td>123.456.789-10</td>
        <td>(11) 91234-5678</td>
        <td>01/01/1990</td>
        <td>
          <button class="botao-editar">Editar</button>
          <button class="botao-excluir">Excluir</button>
        </td>
      </tr>

      <tr>
        <td>José Golçalves</td>
        <td>José.golçalves@hotmail.com</td>
        <td>583.321.875-00</td>
        <td>(11) 91156-8726</td>
        <td>15/05/2000</td>
        <td>
          <button class="botao-editar">Editar</button>
          <button class="botao-excluir">Excluir</button>
        </td>
      </tr>

      <tr>
        <td>Murilo Silva Dias</td>
        <td>Murilo.Dias@gmail.com</td>
        <td>481.211.529-23</td>
        <td>(11) 98859-9785</td>
        <td>02/10/1998</td>
        <td>
          <button class="botao-editar">Editar</button>
          <button class="botao-excluir">Excluir</button>
        </td>
      </tr>

      <tr>
        <td>Maria Clara Costa </td>
        <td>Maria.clara@hotmail.com</td>
        <td>583.321.875-00</td>
        <td>(11) 95836-2255</td>
        <td>14/06/2005</td>
        <td>
          <button class="botao-editar">Editar</button>
          <button class="botao-excluir">Excluir</button>
        </td>
      </tr>

      <tr>
        <td>Pedro Gustavo Rocha</td>
        <td>Pedro.Gustavo@hotmail.com</td>
        <td>123.985.320-52</td>
        <td>(11) 98545-2166</td>
        <td>12/10/2001</td>
        <td>
          <button class="botao-editar">Editar</button>
          <button class="botao-excluir">Excluir</button>
        </td>
      </tr>
      
    </tbody>
  </table>
</div>
@endsection



  