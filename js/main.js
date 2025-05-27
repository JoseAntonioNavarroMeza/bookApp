window.addEventListener("load", function () {
    asociarEventos();

    // Doble clic en encabezados para ordenar
    document.querySelector("th:nth-child(2)").ondblclick = () => ordenarPor("isbn");
    document.querySelector("th:nth-child(3)").ondblclick = () => ordenarPor("titulo");
    document.querySelector("th:nth-child(4)").ondblclick = () => ordenarPor("autor");
    document.querySelector("th:nth-child(5)").ondblclick = () => ordenarPor("tipo");
    document.querySelector("th:nth-child(6)").ondblclick = () => ordenarPor("lenguaje");
    document.querySelector("th:nth-child(7)").ondblclick = () => ordenarPor("stock");
    document.querySelector("th:nth-child(8)").ondblclick = () => ordenarPor("precio");
  });
