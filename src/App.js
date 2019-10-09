import React from 'react';
import logo from './logo.svg';
import './App.css';

import FileInput from './Components/FileInput';
import RadioButtons from './Components/lista';


function App() {
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
      <div>
      <FileInput/>
      <RadioButtons/>
      
      
      </div>
    </div>
  );
}

export default App;
