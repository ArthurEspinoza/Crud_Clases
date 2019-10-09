import React, { Component } from 'react';
import ReactFileReader from 'react-file-reader';


class FileInput extends Component {
  state = {
    filesSelected: ''
  }

  handleFiles = files => {
    var reader = new FileReader();
    reader.onload = function(e) {
    //Use reader.result
    alert(reader.result)
    }
  reader.readAsText(files[0]);
}

  render() {
    return (
        <div className="App">
         
          <p> View Console for output of file selectionn. Use base64 conversion to instantly display selected images. </p>
          <ReactFileReader handleFiles={this.handleFiles} fileTypes={'.xml'}>
            <button className='btn'>Upload</button>
          </ReactFileReader>
        </div>
      );
  }
}

export default FileInput;