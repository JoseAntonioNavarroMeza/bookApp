
window.addEventListener("load", inicio);

function inicio() {
    resumen();
    titulos = document.getElementsByTagName("th");
    titulos[1].addEventListener("dblclick", porISBN);
    titulos[2].addEventListener("dblclick", porTitulo);
    titulos[3].addEventListener("dblclick", porAutor);
    titulos[4].addEventListener("dblclick", porTipo);
    titulos[5].addEventListener("dblclick", porLenguaje);
    titulos[6].addEventListener("dblclick", porStock);
    titulos[7].addEventListener("dblclick", porPrecio);
}

var libroAsc=true;

function porISBN(){ordenar(1)}  
function porTitulo(){ordenar(2)}
function porAutor(){ordenar(3)} 
function porTipo(){ordenar(4)} 
function porLenguaje(){ordenar(5)} 
function porStock(){ordenar(6)} 
function porPrecio(){ordenar(7)} 

function ordenar(columna) {
    var datos = document.getElementsByTagName("td");
    var columnas = 9;
    var filas = datos.length / columnas - 1;
    var matriz = new Array();
    for (i = 0; i < filas; i++)
        matriz[i] = new Array();
    for (i = 0; i < filas; i++)
        for (j = 0; j < columnas; j++)
            matriz[i][j] = datos[i * columnas + j].innerHTML;
    ordenaMatriz(matriz, columna, filas, columnas);
    for (i = 0; i < filas; i++)
        for (j = 0; j < columnas; j++)
            datos[i * columnas + j].innerHTML = matriz[i][j];
    console.log(libroAsc);
    if (libroAsc)
        libroAsc = false;
    else
        libroAsc = true;
}

function ordenaMatriz(matriz, columna, filas, columnas) {
    //vamos a ordenar los datos por la columna valor
    for (h = 0; h < filas - 1; h++)
        for (i = h + 1; i < filas; i++) {
            comp = matriz[h][columna].localeCompare(matriz[i][columna]);
            if (libroAsc == true)
                if (comp == 1)//matriz[i] es mayor que matriz[i+1]
                    intercambia(matriz, i, h);
            if (libroAsc == false)
                if (comp == -1)//matriz[i] es menor que matriz[i+1]
                    intercambia(matriz, i, h);
        }
}

function intercambia(matriz, i, h) {
    vector = new Array();
    columnas = matriz[0].length;
    console.log(i, "<->", i + 1);
    for (x = 0; x < columnas; x++)
        vector[x] = matriz[i][x];
    for (x = 0; x < columnas; x++)
        matriz[i][x] = matriz[h][x];
    for (x = 0; x < columnas; x++)
        matriz[h][x] = vector[x];
}
function imprimeMatriz(matriz) {
    filas = matriz.length;
    columnas = matriz[0].length;
    for (var i = 0; i < filas; i++)
        for (var j = 0; j < columnas; j++)
            console.log(matriz[i][j]);
}

function resumen() {
    filas = document.querySelectorAll("tr");
    totalL = document.getElementById("totalL");
    totalS = document.getElementById("totalS");
    promedioPrecio = document.getElementById("promedioPrecio");

    totalStock = 0;
    totalPrecio = 0;
    contadorLibros = 0;

    for (i = 1; i < filas.length - 1; i++) {
        celdas = filas[i].getElementsByTagName("td");

        if (celdas.length > 0) {
            stock = parseInt(celdas[6].innerText);
            precio = parseFloat(celdas[7].innerText.replace("$", ""));

            totalStock += stock;
            totalPrecio += precio;
            contadorLibros++;
        }
    }

    totalL.innerText = `Total de Libros: ${contadorLibros}`;
    totalS.innerText = `Stock: ${totalStock}`;
    promedioPrecio.innerText = `Promedio: $${(totalPrecio / contadorLibros).toFixed(2)}`;
}
