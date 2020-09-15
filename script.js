function clearConverter() {
    document.getElementById("inputVal").value = '';
    if (document.getElementById('outputs') != null) {
        var list = document.getElementById('outputs');
        list.parentNode.removeChild(list);
    }
}

function getIngParser() {
    PageBody.setState({section: "ingParser"});
}

function getHome() {
    PageBody.setState({section: "Home"});
}

function getAbout() {
    PageBody.setState({section: "About"});
}

function getContributor() {
    PageBody.setState({section: "Contribute"});
}
