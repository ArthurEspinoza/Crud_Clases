import React from 'react';
import './styles.css';

class RadioButtons extends React.Component {
    constructor() {
      super();
      this.state = {
        selectedOption: ''
      };
    this.radioChange = this.radioChange.bind(this);
  }
  
    radioChange(e) {
      this.setState({
        selectedOption: e.currentTarget.value
      });
    }
    
    render() {
      return (
        <div className="lenguaje">
          <p> Seleccione el lenguaje de programación que desee </p>
          <input type="radio"
                 value="Java"
                 checked={this.state.selectedOption === "Java"}
                 onChange={this.radioChange} />Java
  
          <input type="radio"
                 value="C++"
                 checked={this.state.selectedOption === "C++"}
                 onChange={this.radioChange}/>C++
          
          <h3>Usted selecciono el lenguaje: {this.state.selectedOption}</h3>
        </div> 
      );
    }
  }

  export default RadioButtons;