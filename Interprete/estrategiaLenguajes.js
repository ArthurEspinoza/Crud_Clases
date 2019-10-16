//Arreglo de tipos de variables admitidas dentro del programa
var attrTipos = ["String", "Integer", "Real"];
// Funcion para cambiar el tipo
function setNewType(tipo) {
    var nuevoTipo;
    switch (tipo) {
        case "String":
            nuevoTipo = "string";
            break;
        case "Integer":
            nuevoTipo = "int";
            break;
        case "Real":
            nuevoTipo = "float";
            break;

        default:
            console.log("No coincide el tipo con ninguna de las opciones");
            break;
    }
    return nuevoTipo;
}

function setNewTypeJ(tipo) {
    var nuevoTipo;
    switch (tipo) {
        case "String":
            nuevoTipo = "String";
            break;
        case "Integer":
            nuevoTipo = "int";
            break;
        case "Real":
            nuevoTipo = "float";
            break;

        default:
            console.log("No coincide el tipo con ninguna de las opciones");
            break;
    }
    return nuevoTipo;
}
//Funcion que ayuda a buscar la herencia o tipo de atributo correspondiente
function buscarHT(arr, objHT) {
    var resultado = "";
    for (var i = 0; i < arr.length; i++) {
        if (arr[i]["id"] == objHT) {
            resultado = arr[i].nombre;
        }
    }
    return resultado;
}
//Función que ayuda a colocar el nombre y tipo de los atributos - C++
function setAttr(arr, arrC) {
    var resultado = "";
    for (var i = 0; i < arr.length; i++) {
        var checador = i + 1;
        if (checador < arr.length) {
            if (attrTipos.includes(arr[i].tipo) != false) {
                resultado += "\t" + setNewType(arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            } else {
                resultado += "\t" + buscarHT(arrC, arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            }
        } else {
            if (attrTipos.includes(arr[i].tipo) != false) {
                resultado += "\t" + setNewType(arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            } else {
                resultado += "\t" + buscarHT(arrC, arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            }
        }
    }
    return resultado;
}
//Función que ayuda a colocar el nombre y tipo de los atributos - Java
function setAttrJ(arr, arrC) {
    var resultado = "";
    for (var i = 0; i < arr.length; i++) {
        var checador = i + 1;
        if (checador < arr.length) {
            if (attrTipos.includes(arr[i].tipo) != false) {
                resultado += "private " + setNewTypeJ(arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            } else {
                resultado += "private " + buscarHT(arrC, arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            }
        } else {
            if (attrTipos.includes(arr[i].tipo) != false) {
                resultado += "private " + setNewTypeJ(arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            } else {
                resultado += "private " + buscarHT(arrC, arr[i].tipo) + " " + arr[i].nombre + ";\n\t";
            }
        }
    }
    return resultado;
}
//Función que ayuda a colocar el nombre, parametros y tipos de los parametros para los metodos
function setMet(arr, arrC) {
    var resultado = "";
    for (var i = 0; i < arr.length; i++) {
        var checador = i + 1;
        if (checador < arr.length) {
            resultado += "\t" + arr[i].nombre + "( ";
            var arrP = arr[i].parametros;
            for (var j = 0; j < arrP.length; j++) {
                var checadorP = j + 1;
                if (attrTipos.includes(arrP[j].tipo) != false) {
                    resultado += setNewType(arrP[j].tipo) + " " + arrP[j].nombre;
                } else {
                    resultado += buscarHT(arrC, arrP[j].tipo) + " " + arrP[j].nombre;
                }
                if (checadorP < arrP.length) {
                    resultado += ", ";
                }
            }
            resultado += " ){...} \n\t";
        } else {
            resultado += "\t" + arr[i].nombre + "( ";
            var arrPC = arr[i].parametros;
            for (var z = 0; z < arrPC.length; z++) {
                var checadorZ = z + 1;
                if (attrTipos.includes(arrPC[z].tipo) != false) {
                    resultado += setNewType(arrPC[z].tipo) + " " + arrPC[z].nombre;
                } else {
                    resultado += buscarHT(arrC, arrPC[z].tipo) + " " + arrPC[z].nombre;
                }
                if (checadorZ < arrPC.length) {
                    resultado += ", ";
                }
            }
            resultado += " ){...} \n";
        }
    }
    return resultado;
}
//Función que ayuda a colocar el nombre, parametros y tipos de los parametros para los metodos - Java
function setMetJ(arr, arrC) {
    var resultado = "";
    for (var i = 0; i < arr.length; i++) {
        var checador = i + 1;
        if (checador < arr.length) {
            resultado += "public " + arr[i].nombre + "( ";
            var arrP = arr[i].parametros;
            for (var j = 0; j < arrP.length; j++) {
                var checadorP = j + 1;
                if (attrTipos.includes(arrP[j].tipo) != false) {
                    resultado += setNewTypeJ(arrP[j].tipo) + " " + arrP[j].nombre;
                } else {
                    resultado += buscarHT(arrC, arrP[j].tipo) + " " + arrP[j].nombre;
                }
                if (checadorP < arrP.length) {
                    resultado += ", ";
                }
            }
            resultado += " ){...} \n\t";
        } else {
            resultado += "public " + arr[i].nombre + "( ";
            var arrPC = arr[i].parametros;
            console.log(arrPC);
            for (var z = 0; z < arrPC.length; z++) {
                var checadorZ = z + 1;
                if (attrTipos.includes(arrPC[z].tipo) != false) {
                    resultado += setNewTypeJ(arrPC[z].tipo) + " " + arrPC[z].nombre;
                } else {
                    resultado += buscarHT(arrC, arrPC[z].tipo) + " " + arrPC[z].nombre;
                }
                if (checadorZ < arrPC.length) {
                    resultado += ", ";
                }
            }
            resultado += " ){...} \n";
        }
    }
    return resultado;
}
//Patrón Estrategia
var Exportador = function() {
    this.lenguaje = "";
};
Exportador.prototype = {
    setLenguaje: function(lenguaje) {
        this.lenguaje = lenguaje;
    },
    exportar: function(arregloClases) {
        return this.lenguaje.exportar(arregloClases);
    },
    getName: function() {
        return this.lenguaje.getName();
    }
};
var Cmasmas = function() {
    this.exportar = function(arregloClases) {
        var header = "#include&lt;iostream&gt;\nusing namespace std;\n";
        for (var i = 0; i < arregloClases.length; i++) {
            //Asigna el nombre
            header += "class " + arregloClases[i].nombre + " ";
            //console.log(arregloClases[i].herencia);
            if (arregloClases[i].herencia != "" && arregloClases[i].herencia != undefined) {
                header += ": public " + buscarHT(arregloClases, arregloClases[i].herencia);
            }
            header += "{\n\t";
            arrT = arregloClases[i].atributos;
            arrM = arregloClases[i].metodos;
            header += "//Atributos...\n\t";
            header += "private:\n\t";
            header += setAttr(arrT, arregloClases);
            header += "//Metodos...\n\t";
            header += "public:\n\t";
            header += setMet(arrM, arregloClases);
            header += "};\n";
        }
        //header += setAttr(arregloClases[0].atributos, arregloClases);
        return header;
    };
    this.getName = function() {
        return "C++";
    };
};
var JV = function() {
    this.exportar = function(arregloClases) {
        var cadena = "";
        for (var i = 0; i < arregloClases.length; i++) {
            cadena += "public class " + arregloClases[i].nombre + " ";
            if (arregloClases[i].herencia != "" && arregloClases[i].herencia != undefined) {
                cadena += "extends " + buscarHT(arregloClases, arregloClases[i].herencia);
            }
            cadena += "{\n\t";
            arrA = arregloClases[i].atributos;
            arrM = arregloClases[i].metodos;
            cadena += "//Atributos...\n\t";
            cadena += setAttrJ(arrA, arregloClases);
            cadena += "//Metodos...\n\t";
            cadena += setMetJ(arrM, arregloClases);
            cadena += "};\n";
        }
        return cadena;
    };
    this.getName = function() {
        return "JAVA";
    };
};