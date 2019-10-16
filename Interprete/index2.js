const input = document.querySelector('input[type="file"]');
const reader = new FileReader();
let parser = new DOMParser();
var xarchivo;
let arrElementos = []; //Almacena las clases sin formateaer
let arrClases = []; //Almacena las clases formateadas de salida
input.addEventListener('change', function(e) {
    //console.log(input.files);
    reader.onload = function() {
        xarchivo = reader.result;
        //console.log(xarchivo);
    };
    reader.readAsText(input.files[0]);
    arrElementos = [];
    arrClases = [];
}, false);


function xmlToJson(xml) {

    // Create the return object
    var obj = {};

    if (xml.nodeType == 1) { // element
        // do attributes
        if (xml.attributes.length > 0) {
            obj["@attributes"] = {};
            for (var j = 0; j < xml.attributes.length; j++) {
                var attribute = xml.attributes.item(j);
                obj["@attributes"][attribute.nodeName] = attribute.nodeValue;
            }
        }
    } else if (xml.nodeType == 3) { // text
        obj = xml.nodeValue;
    }

    // do children
    if (xml.hasChildNodes()) {
        for (var i = 0; i < xml.childNodes.length; i++) {
            var item = xml.childNodes.item(i);
            var nodeName = item.nodeName;
            if (typeof(obj[nodeName]) == "undefined") {
                obj[nodeName] = xmlToJson(item);
            } else {
                if (typeof(obj[nodeName].push) == "undefined") {
                    var old = obj[nodeName];
                    obj[nodeName] = [];
                    obj[nodeName].push(old);
                }
                obj[nodeName].push(xmlToJson(item));
            }
        }
    }
    return obj;
}


function aJson() {
    var xmlA = parser.parseFromString(xarchivo, 'text/xml');
    var obj = xmlToJson(xmlA);
    console.log(obj);
    console.dir(obj["uml:Model"]["packagedElement"]);
    arrElementos = obj["uml:Model"]["packagedElement"];
    console.log(arrElementos.length);
}

function getElementosArreglo() {
    var nClase;
    var idClase;
    var generalizacion;
    var atributos = [];
    var metodos = [];
    var params = [];
    //console.log(arrElementos);

    /*for (let i = 0; i < arrElementos.length / 2; i++) {
        console.log(arrElementos[i]);
        if (Array.isArray(arrElementos[i]["ownedAttribute"])) {
            console.log(i + "Si es arreglo");

        }
    }*/
    //console.log(arrElementos[0]);
    for (let i = 0; i < arrElementos.length; i++) {
        if (arrElementos[i]["eAnnotations"] == undefined) {
            if (arrElementos[i]["@attributes"]["name"] != undefined) {
                console.log("NombreClase: " + arrElementos[i]["@attributes"]["name"]);
                nClase = arrElementos[i]["@attributes"]["name"];
                console.log("IDClase: " + arrElementos[i]["@attributes"]["xmi:id"]);
                idClase = arrElementos[i]["@attributes"]["xmi:id"];
            }
            if (arrElementos[i]["generalization"] != undefined) {
                console.log("Generalizacion: " + arrElementos[i].generalization["@attributes"].general);
                generalizacion = arrElementos[i].generalization["@attributes"].general;
            }
            if (arrElementos[i]["ownedAttribute"] != undefined) {
                if (Array.isArray(arrElementos[i]["ownedAttribute"])) {
                    arrAtributos = arrElementos[i]["ownedAttribute"];
                    //console.log(arrAtributos[0].type);
                    for (let j = 0; j < arrAtributos.length; j++) {
                        let tipo;
                        console.log(j + " Atributo del array: " + arrAtributos[j]["@attributes"].name);
                        if (arrAtributos[j].type != undefined) {
                            splitTipo = (arrAtributos[j].type["@attributes"].href).split('#');
                            console.log(j + " Tipo: " + splitTipo[1]);
                            tipo = splitTipo[1];
                        } else {
                            tipo = arrAtributos[j]["@attributes"].type
                            console.log(j + " Tipo:" + tipo);
                        }
                        var attrJson = {
                            nombre: arrAtributos[j]["@attributes"].name,
                            tipo: tipo
                        };
                        atributos.push(attrJson);
                    }
                } else {
                    /*console.log("El type no es clase");*/
                    console.log("Atributo " + arrElementos[i]["ownedAttribute"]["@attributes"].name);
                    let tipo;
                    if (arrElementos[i]["ownedAttribute"].type != undefined) {
                        let splitTipo = (arrElementos[i]["ownedAttribute"].type["@attributes"].href).split('#');
                        console.log(i + " Tipo: " + splitTipo[1]);
                        tipo = splitTipo[1];
                    } else {
                        console.log(i + " Tipo:" + arrElementos[i]["ownedAttribute"]["@attributes"].type);
                        tipo = arrElementos[i]["ownedAttribute"]["@attributes"].type;
                    }
                    var attrJsonnA = {
                        nombre: arrElementos[i]["ownedAttribute"]["@attributes"].name,
                        tipo: tipo
                    };
                    atributos.push(attrJsonnA);
                }
            }
            if (arrElementos[i]["ownedOperation"] != undefined) {
                if (Array.isArray(arrElementos[i]["ownedOperation"])) {
                    let arrOperation = arrElementos[i]["ownedOperation"];
                    for (let z = 0; z < arrOperation.length; z++) {
                        console.log(z + " Metodo del array: " + arrOperation[z]["@attributes"].name);
                        if (arrOperation[z]["ownedParameter"] != undefined) {
                            if (Array.isArray(arrOperation[z]["ownedParameter"])) {
                                let arrParams = arrOperation[z]["ownedParameter"];
                                for (let w = 0; w < arrParams.length; w++) {
                                    let ptipo = (arrParams[w].type["@attributes"].href).split('#');
                                    console.log(w + " Parametro: " + arrParams[w]["@attributes"].name);
                                    console.log(w + " Tipo: " + ptipo[1]);
                                    var multiP = {
                                        nombre: arrParams[w]["@attributes"].name,
                                        tipo: ptipo[1]
                                    }
                                    params.push(multiP);
                                }
                            } else {
                                console.log("Parametro: " + arrOperation[z]["ownedParameter"]["@attributes"].name);
                                let ptipo = (arrOperation[z]["ownedParameter"].type["@attributes"].href).split('#');
                                console.log("Tipo: " + ptipo[1]);
                                var unParam = {
                                    nombre: arrOperation[z]["ownedParameter"]["@attributes"].name,
                                    tipo: ptipo[1]
                                };
                                params.push(unParam);
                            }
                        }
                        var metJson = {
                            nombre: arrOperation[z]["@attributes"].name,
                            parametros: params
                        };
                        metodos.push(metJson);
                        params = [];
                    }
                } else {
                    console.log("Metodo: " + arrElementos[i]["ownedOperation"]["@attributes"].name);
                    if (arrElementos[i]["ownedOperation"]["ownedParameter"] != undefined) {
                        if (Array.isArray(arrElementos[i]["ownedOperation"]["ownedParameter"])) {
                            let arrParams = arrElementos[i]["ownedOperation"]["ownedParameter"];
                            for (let w = 0; w < arrParams.length; w++) {
                                let ptipo = (arrParams[w].type["@attributes"].href).split('#');
                                console.log(w + " Parametro: " + arrParams[w]["@attributes"].name);
                                console.log(w + " Tipo: " + ptipo[1]);
                                var multiParam = {
                                    nombre: arrParams[w]["@attributes"].name,
                                    tipo: ptipo[1]
                                }
                                params.push(multiParam);
                            }
                        } else {
                            var ptipo = (arrElementos[i]["ownedOperation"]["ownedParameter"].type["@attributes"].href).split('#');
                            console.log("Parametro: " + arrElementos[i]["ownedOperation"]["ownedParameter"]["@attributes"].name);
                            console.log("Tipo: " + ptipo[1]);
                            var parametro = {
                                nombre: arrElementos[i]["ownedOperation"]["ownedParameter"]["@attributes"].name,
                                tipo: ptipo[1]
                            }
                            params.push(parametro);
                        }
                    }
                    var metJson = {
                        nombre: arrElementos[i]["ownedOperation"]["@attributes"].name,
                        parametros: params
                    }
                    metodos.push(metJson);
                    params = [];
                }
            }
            var ClassJson = {
                nombre: nClase,
                id: idClase,
                herencia: generalizacion,
                atributos: atributos,
                metodos: metodos
            }
            arrClases.push(ClassJson);
            generalizacion = "";
            tipoA = "";
            atributos = [];
            metodos = [];
        }
    }
}

function getElementos() {
    if (arrElementos.length != undefined) {
        getElementosArreglo();
    } else {
        console.log("Soy solo un objeto");
        var nClase;
        var idClase;
        var generalizacion;
        var atributos = [];
        var metodos = [];
        var params = [];
        if (arrElementos["eAnnotations"] == undefined) {
            //Nombre de la Clase
            if (arrElementos["@attributes"]["name"] != undefined) {
                console.log("NombreClase: " + arrElementos["@attributes"]["name"]);
                nClase = arrElementos["@attributes"]["name"];
                console.log("IDClase: " + arrElementos["@attributes"]["xmi:id"]);
                idClase = arrElementos["@attributes"]["xmi:id"];
            }
            //Atributos de la clase
            if (arrElementos["ownedAttribute"] != undefined) {
                if (Array.isArray(arrElementos["ownedAttribute"])) {
                    arrAtributos = arrElementos["ownedAttribute"];
                    //console.log(arrAtributos[0].type);
                    for (let j = 0; j < arrAtributos.length; j++) {
                        let tipo;
                        console.log(j + " Atributo del array: " + arrAtributos["@attributes"].name);
                        if (arrAtributos.type != undefined) {
                            splitTipo = (arrAtributos.type["@attributes"].href).split('#');
                            console.log(j + " Tipo: " + splitTipo[1]);
                            tipo = splitTipo[1];
                        } else {
                            tipo = arrAtributos["@attributes"].type
                            console.log(j + " Tipo:" + tipo);
                        }
                        var attrJson = {
                            nombre: arrAtributos["@attributes"].name,
                            tipo: tipo
                        };
                        atributos.push(attrJson);
                    }
                } else {
                    /*console.log("El type no es clase");*/
                    console.log("Atributo " + arrElementos["ownedAttribute"]["@attributes"].name);
                    let tipo;
                    if (arrElementos["ownedAttribute"].type != undefined) {
                        let splitTipo = (arrElementos["ownedAttribute"].type["@attributes"].href).split('#');
                        console.log(" Tipo: " + splitTipo[1]);
                        tipo = splitTipo[1];
                    } else {
                        console.log(" Tipo:" + arrElementos["ownedAttribute"]["@attributes"].type);
                        tipo = arrElementos["ownedAttribute"]["@attributes"].type;
                    }
                    var attrJsonnA = {
                        nombre: arrElementos["ownedAttribute"]["@attributes"].name,
                        tipo: tipo
                    };
                    atributos.push(attrJsonnA);
                }
            }
            //Metodos de la clase
            if (arrElementos["ownedOperation"] != undefined) {
                if (Array.isArray(arrElementos["ownedOperation"])) {
                    let arrOperation = arrElementos["ownedOperation"];
                    for (let z = 0; z < arrOperation.length; z++) {
                        console.log(z + " Metodo del array: " + arrOperation[z]["@attributes"].name);
                        if (arrOperation[z]["ownedParameter"] != undefined) {
                            if (Array.isArray(arrOperation[z]["ownedParameter"])) {
                                let arrParams = arrOperation[z]["ownedParameter"];
                                for (let w = 0; w < arrParams.length; w++) {
                                    let ptipo = (arrParams[w].type["@attributes"].href).split('#');
                                    console.log(w + " Parametro: " + arrParams[w]["@attributes"].name);
                                    console.log(w + " Tipo: " + ptipo[1]);
                                    var multiP = {
                                        nombre: arrParams[w]["@attributes"].name,
                                        tipo: ptipo[1]
                                    }
                                    params.push(multiP);
                                }
                            } else {
                                console.log("Parametro: " + arrOperation[z]["ownedParameter"]["@attributes"].name);
                                let ptipo = (arrOperation[z]["ownedParameter"].type["@attributes"].href).split('#');
                                console.log("Tipo: " + ptipo[1]);
                                var unParam = {
                                    nombre: arrOperation[z]["ownedParameter"]["@attributes"].name,
                                    tipo: ptipo[1]
                                };
                                params.push(unParam);
                            }
                        }
                        var metJson = {
                            nombre: arrOperation[z]["@attributes"].name,
                            parametros: params
                        };
                        metodos.push(metJson);
                        params = [];
                    }
                } else {
                    console.log("Metodo: " + arrElementos["ownedOperation"]["@attributes"].name);
                    if (arrElementos["ownedOperation"]["ownedParameter"] != undefined) {
                        if (Array.isArray(arrElementos["ownedOperation"]["ownedParameter"])) {
                            let arrParams = arrElementos["ownedOperation"]["ownedParameter"];
                            for (let w = 0; w < arrParams.length; w++) {
                                let ptipo = (arrParams[w].type["@attributes"].href).split('#');
                                console.log(w + " Parametro: " + arrParams[w]["@attributes"].name);
                                console.log(w + " Tipo: " + ptipo[1]);
                                var multiParam = {
                                    nombre: arrParams[w]["@attributes"].name,
                                    tipo: ptipo[1]
                                }
                                params.push(multiParam);
                            }
                        } else {
                            var ptipo = (arrElementos["ownedOperation"]["ownedParameter"].type["@attributes"].href).split('#');
                            console.log("Parametro: " + arrElementos["ownedOperation"]["ownedParameter"]["@attributes"].name);
                            console.log("Tipo: " + ptipo[1]);
                            var parametro = {
                                nombre: arrElementos["ownedOperation"]["ownedParameter"]["@attributes"].name,
                                tipo: ptipo[1]
                            }
                            params.push(parametro);
                        }
                    }
                    var metJson = {
                        nombre: arrElementos["ownedOperation"]["@attributes"].name,
                        parametros: params
                    }
                    metodos.push(metJson);
                    params = [];
                }
            }
            console.log(nClase);
            console.log(idClase);
            console.log(atributos);
            var ClassJson = {
                nombre: nClase,
                id: idClase,
                atributos: atributos,
                metodos: metodos
            }
            arrClases.push(ClassJson);
            generalizacion = "";
            tipoA = "";
            atributos = [];
            metodos = [];
        }
    }
}

function verJson() {
    console.log(arrClases);
}

function runA() {
    var opciones = document.getElementById("lengOpc");
    var exportador = new Exportador();
    var lenguaje;
    switch (opciones.options[opciones.selectedIndex].text) {
        case "C++":
            lenguaje = new Cmasmas();
            break;
        case "JAVA":
            lenguaje = new JV();
            break;
        default:
            alert("Ninguna opción seleccionada");
            break;
    }
    exportador.setLenguaje(lenguaje);
    console.log(exportador.getName());
    console.log(exportador.exportar(arrClases))
    document.getElementById("resultado").innerHTML = exportador.getName() + "\n" + exportador.exportar(arrClases);
    document.getElementById("archivo").value = "";
}