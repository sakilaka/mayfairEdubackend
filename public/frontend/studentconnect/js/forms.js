(function () {
  const formContainers = document.getElementsByClassName(
    "studentconnectWebForms"
  );

  function executeScriptElements(containerElement) {
    const scriptElements = containerElement.querySelectorAll("script");

    Array.from(scriptElements).forEach((scriptElement) => {
      const clonedElement = document.createElement("script");

      Array.from(scriptElement.attributes).forEach((attribute) => {
        clonedElement.setAttribute(attribute.name, attribute.value);
      });

      clonedElement.text = scriptElement.text;

      scriptElement.parentNode.replaceChild(clonedElement, scriptElement);
    });
  }

  function makeHttpObject() {
    try {
      return new XMLHttpRequest();
    } catch (error) {}

    try {
      return new ActiveXObject("Msxml2.XMLHTTP");
    } catch (error) {}

    try {
      return new ActiveXObject("Microsoft.XMLHTTP");
    } catch (error) {}

    throw new Error("Could not create HTTP request object.");
  }

  for (let i = 0; i < formContainers.length; i++) {
    const formContainer = formContainers[i],
      webform = formContainer.dataset.webform,
      request = makeHttpObject();

    request.open("GET", webform, true);
    request.send(null);
    request.onreadystatechange = function () {
      if (request.status === 200 && request.readyState == 4) {
        formContainer.innerHTML = request.responseText;
        executeScriptElements(formContainer);
      }
    };
  }

  function _load_script(url) {
    const head = document.querySelector("head"),
      script = document.createElement("script");

    script.type = "text/javascript";
    script.charset = "utf-8";
    script.src = url;

    head.appendChild(script);
  }
})();
