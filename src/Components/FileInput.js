import React, { Component } from 'react';
import ReactFileReader from 'react-file-reader';
import './styles.css';

class FileInput extends Component {
  state = {
    filesSelected: ''
  }

  handleFiles = files => {
    var reader = new FileReader();
    reader.onload = function(e) {
    //Use reader.result
    alert("Se ha cargado con exito!!")//reader.result)
    }
  reader.readAsText(files[0]);
}

  render() {
    return (
        <div className="lenguaje">
         
          <p> Seleccione el archivo XML que desea cargar </p>
          <ReactFileReader handleFiles={this.handleFiles} fileTypes={'.xml'}>
            <button className='btn'>Cargar archivo</button>
          </ReactFileReader>
          
        </div>
      );
  }
}

export default FileInput;