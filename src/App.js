import React, {Component} from 'react';
import ReactFileReader from 'react-file-reader';
import logo from './logo.svg';
import './App.css';
//import $ from 'jquery';

class App extends Component{
  constructor() {
    super();
    this.state = { selectedOption: '', filesSelected: '' };
    this.radioChange = this.radioChange.bind(this);
    this.handleSubmit = this.handleSubmit.bind(this);
  }

  radioChange(e) {
    this.setState({
      selectedOption: e.currentTarget.value
    });
  }

  handleSubmit(event) {
    event.preventDefault();
    alert('Datos:' + this.state.filesSelected + " "+ this.state.selectedOption); 
    console.log(this.state);
      
  }

 

handleFiles = files => {
  var reader = new FileReader();
  reader.onload = function(e) {
  //Use reader.result
  alert("Se ha cargado con exito!!")//reader.result)
  }
reader.readAsText(files[0]);
this.setState({filesSelected : files[0]});
}

  render() {
    return (
      <div className="App">
        <header className="App-header">
          <div className="left">
            <img src={logo} className="App-logo" alt="logo" />
          </div>
          <div className="lista">
            <h1 className="titulo">Equipo 1</h1>
              <ul className="ul">
                <li>Ayala Aldana Jose Armando</li>
                <li>Espinoza Quintero Arturo</li>
                <li>Hernandez Solis Magda Lucia</li>
                <li>Sanchez Gonzalez Mario </li>
                <li>Sayago Arcos Miguel Angel</li>
              </ul>
          </div>
        </header>
        <div className="lenguaje">
         
         <p> Seleccione el archivo XML que desea cargar </p>
         <ReactFileReader name='archivo' handleFiles={this.handleFiles} fileTypes={'.xml'}>
           <button className='btn'>Cargar archivo</button>
         </ReactFileReader>
         
       </div>
        <div className="lenguaje">
          <p> Seleccione el lenguaje de programación que desee </p>
              <input name='lenguaje' type="radio"
               value="Java"
               checked={this.state.selectedOption === "Java"}
               onChange={this.radioChange} />Java

              <input name='lenguaje' type="radio"
               value="C++"
               checked={this.state.selectedOption === "C++"}
               onChange={this.radioChange}/>C++
        
          <h3>Usted selecciono el lenguaje: {this.state.selectedOption}</h3>
        </div> 
        <button className='btn' onClick={this.handleSubmit}> Enviar</button>
      </div>
    );
  }
}

export default App;
