import React from 'react';
import logo from './logo.svg';
import './App.css';

import FileInput from './Components/FileInput';
import RadioButtons from './Components/lista';


function App() {
  return (
    <div className="App">
      <header className="App-header">
        <img src={logo} className="App-logo" alt="logo" />
        
        
      </header>
      <div>
      <RadioButtons/>
      <FileInput/>
      
      </div>
    </div>
  );
}

export default App;
