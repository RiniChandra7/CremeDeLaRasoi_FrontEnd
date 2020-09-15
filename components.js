class DryConverter extends React.Component {
    //https://www.traditionaloven.com/culinary-arts/sugars/granulated-sugar/granulated-sugar-multimenu.html
    constructor(props) {
        super(props);
        this.state = {
            inputType: "none",
            outputType: ["g", "cups", "oz", "lbs", "tbsp", "tsp"],
            outputQty: {
                gToAll: {
                    g: 1,
                    cups: 0.00473,
                    oz: 0.03527,
                    lbs: 0.00220,
                    tbsp: 0.08,
                    tsp: 0.23471
                },
                cupsToAll: {
                    g: 240.07956,
                    cups: 1,
                    oz: 8.47,
                    lbs: 0.52928,
                    tbsp: 19.20636,
                    tsp: 57.61909
                },
                ozToAll: {
                    g: 28.34952,
                    cups: 0.11808,
                    oz: 1,
                    lbs: 0.06250,
                    tbsp: 2.26796,
                    tsp: 6.80389
                },
                lbsToAll: {
                    g: 453.59237,
                    cups: 2.14629,
                    oz: 16.00,
                    lbs: 1,
                    tbsp: 36.28739,
                    tsp: 108.86217
                },
                tbspToAll: {
                    g: 12.50,
                    cups: 0.05915,
                    oz: 0.44092,
                    lbs: 0.02756,
                    tbsp: 1,
                    tsp: 3.00
                },
                tspToAll: {
                    g: 4.16667,
                    cups: 0.01736,
                    oz: 0.14697,
                    lbs: 0.00919,
                    tbsp: 0.33333,
                    tsp: 1
                }
            }
        };
    }

    inputTypeHandler = (e) => {
        this.setState({
            inputType: e.target.value
        });
        if (document.getElementById("inputSeg").style.display == 'none') {
            document.getElementById("inputVal").disabled = false;
            document.getElementById("inputSeg").style.display = 'block';
        } else {
            document.getElementById("inputVal").value = '';
            if (document.getElementById('outputs') != null) {
                var list = document.getElementById('outputs');
                list.parentNode.removeChild(list);
            }
        }                
    }

    inputValHandler = (e) => {
        if (isNaN(e.target.value) || (e.target.value) < 0) {
            document.getElementById("valErrMsg").style.display = 'block';
        } else {
            document.getElementById("valErrMsg").style.display = 'none';

            if (document.getElementById('outputs') != null) {
                var list = document.getElementById('outputs');
                list.parentNode.removeChild(list);
            }
            var inp = this.state.inputType + "ToAll";
            var qty = e.target.value;
            var ul = document.createElement('ul');
            ul.setAttribute('id', 'outputs');
            document.getElementById("outputList").appendChild(ul);
            var allOp = this.state.outputQty[inp];
            var units = this.state.outputType;
            units.forEach(function(op) {
                var li = document.createElement('li');
                ul.appendChild(li);
                var ans = qty*(allOp[op]);
                var conv = "<b>"+ op + "</b>: " + (ans.toFixed(2));
                li.innerHTML += conv;
            });
        }
    }

    render() {
        let errStyle = {
            color: 'red',
            display: 'none'
        };
        let inputPart = (
            <div>
                <form name="dryConverterForm" id="dryConverterForm">
                    <div class="col-lg-6">
                        <label>
                            <input type="radio" name="inputType" id="g" value="g" onChange={this.inputTypeHandler} /> g
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="cups" value="cups" onChange={this.inputTypeHandler} /> cups
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="oz" value="oz" onChange={this.inputTypeHandler} /> oz
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="lbs" value="lbs" onChange={this.inputTypeHandler} /> lbs
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="tbsp" value="tbsp" onChange={this.inputTypeHandler} /> tbsp
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="tsp" value="tsp" onChange={this.inputTypeHandler} /> tsp
                        </label>
                        <br />
                        <label style={{display: 'none'}} id="inputSeg">
                            Enter value in {this.state.inputType} here:
                            <input type="text" name="inputVal" id="inputVal" style={{width: '15%'}} disabled onChange={this.inputValHandler} />
                        </label>
                        <p id="valErrMsg" style={errStyle}>Please enter a numerical value.</p>
                    </div>
                    <div class="col-lg-6" id="outputList">
                    </div>
                </form>
            </div>
        );
        return inputPart;
    }
}

class WetConverter extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            inputType: "none",
            outputType: ["ml", "cups", "oz", "tbsp", "tsp"],
            outputQty: {
                mlToAll: {
                    ml: 1,
                    cups: 0.00351951,
                    oz: 0.035195096903264118,
                    tbsp: 0.056312131777599583327,
                    tsp: 0.16893639532328558195
                },
                cupsToAll: {
                    ml: 284.131,
                    cups: 1,
                    oz: 10.000013200122,
                    tbsp: 16.000014509145429997,
                    tsp: 48.000043524733307265
                },
                ozToAll: {
                    ml: 28.413102505592661373,
                    cups: 0.10000014959878542053,
                    oz: 1,
                    tbsp: 1.6000015916950021122,
                    tsp: 4.8000047748147078863
                },
                tbspToAll: {
                    ml: 17.7582,
                    cups: 0.0625,
                    oz: 0.625,
                    tbsp: 1,
                    tsp: 4.8
                },
                tspToAll: {
                    ml: 0.208333,
                    cups: 0.0208333,
                    oz: 0.208333,
                    tbsp: 0.333333,
                    tsp: 1
                }
            }
        }
    }

    inputTypeHandler = (e) => {
        this.setState({
            inputType: e.target.value
        });
        if (document.getElementById("inputSeg").style.display == 'none') {
            document.getElementById("inputVal").disabled = false;
            document.getElementById("inputSeg").style.display = 'block';
        } else {
            document.getElementById("inputVal").value = '';
            if (document.getElementById('outputs') != null) {
                var list = document.getElementById('outputs');
                list.parentNode.removeChild(list);
            }
        }
    }

    inputValHandler = (e) => {
        if (isNaN(e.target.value) || (e.target.value) < 0) {
            document.getElementById("valErrMsg").style.display = 'block';
        } else {
            document.getElementById("valErrMsg").style.display = 'none';

            if (document.getElementById('outputs') != null) {
                var list = document.getElementById('outputs');
                list.parentNode.removeChild(list);
            }
            var inp = this.state.inputType + "ToAll";
            var qty = e.target.value;
            var ul = document.createElement('ul');
            ul.setAttribute('id', 'outputs');
            document.getElementById("outputList").appendChild(ul);
            var allOp = this.state.outputQty[inp];
            var units = this.state.outputType;
            units.forEach(function(op) {
                var li = document.createElement('li');
                ul.appendChild(li);
                var ans = qty*(allOp[op]);
                var conv = "<b>"+ op + "</b>: " + (ans.toFixed(2));
                li.innerHTML += conv;
            });
        }
    }

    render() {
        let errStyle = {
            color: 'red',
            display: 'none'
        };
        let inputPart = (
            <div>
                <form name="wetConverterForm" id="wetConverterForm">
                    <div class="col-lg-6">
                        <label>
                            <input type="radio" name="inputType" id="ml" value="ml" onChange={this.inputTypeHandler} /> ml
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="cups" value="cups" onChange={this.inputTypeHandler} /> cups
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="oz" value="oz" onChange={this.inputTypeHandler} /> oz
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="tbsp" value="tbsp" onChange={this.inputTypeHandler} /> tbsp
                        </label>
                        <br />
                        <label>
                            <input type="radio" name="inputType" id="tsp" value="tsp" onChange={this.inputTypeHandler} /> tsp
                        </label>
                        <br />
                        <label style={{display: 'none'}} id="inputSeg">
                            Enter value in {this.state.inputType} here:
                            <input type="text" name="inputVal" id="inputVal" style={{width: '15%'}} disabled onChange={this.inputValHandler} />
                        </label>
                        <p id="valErrMsg" style={errStyle}>Please enter a valid numerical value.</p>
                    </div>
                    <div class="col-lg-6" id="outputList">
                    </div>
                </form>
            </div>
        );
        return inputPart;
    }
}

class Converter extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            type: "No"
        };
    }

    ingTypeCheckHandler = (e) => {
        this.setState({
            type: e.target.value
        });
    }

    render() {
        let conv = '';
        if (this.state.type == "Wet") {
            conv = <WetConverter />;
        } else if (this.state.type == "Dry") {
            conv = <DryConverter />;
        }
        
        let typePick = (
            <div class="col-lg-12">
                <form name="converterForm" id="converterForm">
                    <label>
                        <input type="radio" name="ingType" id="Wet" value="Wet" onChange={this.ingTypeCheckHandler} /> Wet
                    </label>
                    &nbsp; &nbsp; &nbsp; &nbsp;
                    <label>
                        <input type="radio" name="ingType" id="Dry" value="Dry" onChange={this.ingTypeCheckHandler} /> Dry
                    </label>
                </form>
                <p id="ingTypeMsg">You've chosen {this.state.type} ingredient!</p>
                {conv}
            </div>
        );
        return typePick;
    }
}
ReactDOM.render(<Converter />, document.getElementById('calc'));

class About extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let body = (
            <div>
                <h3 class="col_text">About Creme de la Rasoi</h3>
                <hr />
                <p>
                    Vivamus rhoncus sagittis nisi vitae accumsan. Donec scelerisque nisi diam, in eleifend odio vulputate quis. Mauris nibh neque, 
                    commodo ut dui ut, posuere tristique mauris. Vivamus eros nulla, accumsan vitae luctus vitae, feugiat ut velit. Praesent mauris
                    libero, imperdiet vitae elit ut, condimentum ultrices risus. Proin in varius nisi, eget egestas turpis. Proin pharetra nunc eu
                    lorem lobortis facilisis. Quisque pretium ante ac dignissim vestibulum. Donec consequat est quis varius finibus. Aliquam 
                    ultricies massa eu sem volutpat, eu congue justo viverra. Donec in pharetra arcu, ac mattis dolor. Suspendisse potenti. 
                    Cras ut eros a ex interdum condimentum nec eu lorem. Cras malesuada cursus libero at pharetra. Mauris et sem ligula.
                </p>
                <p>
                    Aenean vel lacus odio. Duis sem nibh, laoreet sed lectus in, molestie volutpat erat. Ut consectetur tincidunt odio eu dictum. Aliquam a est nunc. Suspendisse egestas tristique lorem non laoreet. Integer id mauris posuere, efficitur libero nec, vestibulum ex. Cras pharetra augue in massa dapibus, porta pharetra dolor finibus. Vestibulum a ex non mi volutpat pellentesque sit amet eget diam. Proin at lorem lectus. Proin ex odio, interdum vel dignissim sit amet, volutpat sit amet lacus. Aliquam eleifend metus ac feugiat pulvinar.
                </p>
                <p>
                    Cras lacinia elit nisi, quis gravida enim porta eu. Cras lorem nulla, pellentesque id mattis quis, placerat ut ex. Etiam velit magna, lacinia eget elementum tincidunt, convallis in augue. Vestibulum mi risus, pretium venenatis efficitur a, faucibus nec diam. Ut quis odio laoreet, vehicula diam ut, facilisis felis. Nam magna mauris, sodales sit amet dolor quis, ultrices dignissim eros. Morbi at lectus et turpis dignissim dictum. Sed convallis ipsum vitae elit ornare dignissim. Fusce eget lectus sapien. Mauris magna nisi, porttitor at ultrices nec, blandit ac dolor. Nulla at maximus turpis. Curabitur sit amet odio pharetra, posuere velit tristique, laoreet nunc. Vestibulum gravida dapibus turpis, in congue nisi egestas quis. Sed nec nisi ut metus euismod finibus non ac sapien. Ut auctor sapien facilisis lorem pellentesque sollicitudin.
                </p>
            </div>
        );
        return body;
    }
}

class Contribute extends React.Component {
    constructor(props) {
        super(props);
    }

    recipeForm = (e) => {
        PageBody.setState({section: "RecipeForm"});
    }

    ingForm = (e) => {
        PageBody.setState({section: "IngForm"});
    }

    render() {
        let body = (
            <div>
                <h3 class="col_text">What do you wish to contribute?</h3>
                <hr />
                <div class="col-lg-6">
                    <button type="button" class="btn col_btn" onClick={this.recipeForm}>A New Recipe</button>
                </div>
                <div class="col-lg-6">
                    <button type="button" class="btn col_btn" onClick={this.ingForm}>A New Ingredient</button>
                </div>
            </div>
        );
        return body;
    }
}

class Home extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let body = (
            <div>
                <h3 class="col_text">Magic - Now in your Rasoi</h3>
                <hr />
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="food1.jpg" class="center-block" alt="..." />
                        <div class="carousel-caption">
                            <h2>Your culinary journey starts here...</h2>
                        </div>
                    </div>
                    <div class="item">
                        <img src="food2.jpg" class="center-block" alt="..." />
                        <div class="carousel-caption">
                            <h2>The best of the world at your fingertips</h2>
                        </div>
                    </div>
                    <div class="item">
                        <img src="food3.jpg" class="center-block" alt="..." />
                        <div class="carousel-caption">
                            <h2>Weave the magic of taste in your kitchen</h2>
                        </div>
                    </div>
                </div>

                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            </div>                    
        );
        return body;
    }
}

class IngParser extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let body = (
            <div>
                <h3 class="col_text">Know what you need</h3>
                <hr />
                <div>
                    <div class="col-lg-6">
                        <form>
                            <b>Enter a segment of your recipe and we'll filter out the ingredients for you to know better:</b>
                        </form>
                        <textarea class="form-control" rows="9">
                            Take 1g of salt in a bowl, add a cup of water and mix well to get a paste. Then add 2 tbsp chillies & onions and saute it.
                        </textarea>
                    </div>    
                    <div class="col-lg-6">
                        <div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                Salt</a>
                            </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                Chillies</a>
                            </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                Onions</a>
                            </h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                            minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat.</div>
                            </div>
                        </div>
                        </div>
                    </div> 
                </div>
            </div>
        );
        return body;
    }
}

class PageBody extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            section: "Home"
        };
    }

    render() {
        let body = '';
        if (this.state.section == "About") {
            body = <About />;
        } else if (this.state.section == "ingParser") {
            body = <IngParser />;
        } else if (this.state.section == "Contribute") {
            body = <Contribute />;
        } else if (this.state.section == "RecipeForm") {
            body = <RecipeForm />;
        } else if (this.state.section == "IngForm") {
            body = <IngForm />;
        } else if (this.state.section == "Tips") {
            body = <Tips />;
        } else {
            body = <Home />;
        }
        
        return body;
    }
}
ReactDOM.render(<PageBody ref={PageBody => {window.PageBody = PageBody}} />, document.getElementById('page_content'));

