<?php
    session_start();
    if ($_SESSION['UserName'] != "Rini") {
        $_SESSION['UserName'] = "Guest";
        $_SESSION['UserId'] = 0;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Creme de la Rasoi</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
        <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
        <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
        <script src="https://unpkg.com/@babel/standalone/babel.min.js"></script>
        <link href="style.css" rel="stylesheet">
    </head>
    <body class="backdrop">
        <script type="text/babel">
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
                                Creme de la Rasoi  is a one-stop online portal for cooking enthusiasts who want to learn as well as showcase their talent to the world would be a very useful solution for them. Most existing solutions and tools are scattered in nature, and users have to try different solutions until they have found the best fit. Creme de la Rasoi aims to be that all-in-one, feature-loaded solution which has almost everything that a cooking enthusiast may need to learn, grow and hone his/her skills. With Creme de la Rasoi, you can have the confidence to tackle any recipe you want, in your way, whether it is your first time making it or the 100th. It helps you enhance your culinary skills, grow as a cook and help others grow too.                            
                            </p>
                        </div>
                    );
                    return body;
                }
            }

            class RecipeList extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        cuisine: this.props.cuisine,
                        category: this.props.category,
                        allCuisine: ["Indian", "Chinese", "Mexican", "French", "Italian", "American", "British", "Spanish", "Arabic", "Fusion or Continental", "Other"],
                        allCat: ["Vegetarian", "Non-Vegetarian"]
                    }
                }

                render() {
                    let body = '';
                    let cus = this.state.allCuisine;
                    let cat = this.state.allCat;

                    if (cus.indexOf(this.state.cuisine) != -1) {

                    } else if (cat.indexOf(this.state.category) == -1) {

                    }

                    return body;
                }
            }

            class RecipeCard extends React.Component {
                constructor(props) {
                    super(props);
                }

                heartChange = (e) => {
                    document.getElementById("heart").style.color = "red";
                }

                render() {
                    let picStyle = {
                        border: "5px solid #CC5500",
                        borderRadius: "5px"
                    };
                    let body = '';
                    body = (
                        <div>
                        <div class="col-lg-2"></div>
                        <table cellpadding="5" class="col-lg-8">
                            <tr>
                                <td colspan="2" class="col_text"><h4>Coconut Laddu</h4><hr /></td>
                            </tr> 
                            <tr>
                                <td>
                                    <i class="fa fa-pencil" title="Edit" aria-hidden="true" style={{color: "green"}}></i>&nbsp; &nbsp;
                                    <i class="fa fa-heart" title="Bookmark" aria-hidden="true" id="heart" onClick={this.heartChange}></i>&nbsp; &nbsp;
                                    <i class="fa fa-arrow-down" title="Downvotes" aria-hidden="true" style={{color: "#CC5500"}}></i>
                                    <span id="upvoteC" style={{color: "#CC5500"}}>0</span>&nbsp; &nbsp;
                                    <i class="fa fa-arrow-up" title="Upvotes" aria-hidden="true" style={{color: "#CC5500"}}></i>
                                    <span id="downvoteC" style={{color: "#CC5500"}}>0</span>&nbsp; &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td align="left">
                                    <input type="checkbox" id="ing1" name="ing1" value="Coconuts" />
                                    <label for="ing1">1 cup dessicated Coconuts</label><br />
                                    <input type="checkbox" id="ing2" name="ing2" value="Jaggery" />
                                    <label for="ing2">1/4 cup Jaggery </label><br />
                                    <input type="checkbox" id="ing3" name="ing3" value="Milk" />
                                    <label for="ing3">1/2 cup Milk </label><br />
                                    <input type="checkbox" id="ing4" name="ing4" value="Ghee" />
                                    <label for="ing4">1 tbsp Ghee </label><br />
                                    <input type="checkbox" id="ing5" name="ing5" value="Sugar" />
                                    <label for="ing5">To Taste Sugar</label>
                                </td>
                                <td align="right">
                                    <img src="coconutladdu.jpg" width="200px" height="200px" style={picStyle} />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                <p>In a hot pan, add Ghee and heat it. Then, add the dessicated Coconut and roast for sometime. Then add Jaggery and Sugar in powdered form, followed by milk. Mix well, and keep stirring until you get a thick halwa-like consistency. Cool this mixture, form laddus and serve.</p>
                                </td>
                            </tr>
                        </table>
                        <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class Contribute extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        formType: "None"
                    };
                }

                recipeForm = (e) => {
                    e.preventDefault();
                    this.setState({
                        formType: "recipe"
                    });
                }

                ingForm = (e) => {
                    
                    this.setState({
                        formType: "ingredient"
                    });
                }

                tipForm = (e) => {
                    this.setState({
                        formType: "tip"
                    });
                }
 
                render() {
                    let hide = {
                        display: 'none'
                    }

                    let form = '';
                    if (this.state.formType == "recipe") {
                        //form = <RecipeForm />;
                        //document.getElementById("contri").appendChild("RecipeForm");
                        document.getElementById("recipeForm").style.display = "block";
                        document.getElementById("tipForm").style.display = "none";
                        document.getElementById("ingForm").style.display = "none";
                    } else if (this.state.formType == "tip") {
                        //form = <TipsForm />;
                        document.getElementById("tipForm").style.display = "block";
                        document.getElementById("recipeForm").style.display = "none";
                        document.getElementById("ingForm").style.display = "none";
                    } else if (this.state.formType == "ingredient") {
                        //form = <IngForm />;
                        document.getElementById("ingForm").style.display = "block";
                        document.getElementById("recipeForm").style.display = "none";
                        document.getElementById("tipForm").style.display = "none";
                    } else {
                        form = '';
                    }
                    let body = (
                        <div id="contri">
                            <h3 class="col_text">What do you wish to contribute?</h3>
                            <hr />
                            <div class="col-lg-4">
                                <a href="#" type="button" class="btn col_btn" value="recipe" data-toggle="modal" data-target="#recForm">A New Recipe</a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#" type="button" class="btn col_btn" value="tip" data-toggle="modal" data-target="#tipForm">A New Tip or Trick</a>
                            </div>
                            <div class="col-lg-4">
                                <a href="#" type="button" class="btn col_btn" value="ingredient" data-toggle="modal" data-target="#ingForm">A New Ingredient</a>
                            </div>
                            <div id="tipForm" class="modal" tabindex="-1" role="dialog" aria-labelledby="regTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="regTitle">
                                                <b class="col_text">Your Tip</b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div class="modal-body col-lg-12"><TipsForm /></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                            <button type="submit" id="butsave" class="signup btn col_btn">Submit Tip</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="recForm" class="modal" tabindex="-1" role="dialog" aria-labelledby="regTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="regTitle">
                                                <b class="col_text">Your Recipe</b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div class="modal-body col-lg-12"><RecipeForm /></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                            <button type="submit" id="butsave" class="signup btn col_btn">Submit Recipe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div id="ingForm" class="modal" tabindex="-1" role="dialog" aria-labelledby="regTitle" aria-hidden="true" >
                                <div class="modal-dialog modal-dialog-scrollable" role="document">
                                    <form class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title" id="regTitle">
                                                <b class="col_text">New Ingredient</b>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </h3>
                                        </div>
                                        <div class="modal-body col-lg-12"><IngForm /></div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn" data-dismiss="modal">Close</button>
                                            <button type="submit" id="butsave" class="signup btn col_btn">Submit Ingredient</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                    );
                    return body;
                }
            }

            class IngForm extends React.Component {
                constructor(props) {
                    super(props);
                }

                render() {
                    let body = (
                        <div align="center">
                            <div>
                                <form action="#" method="post" name="newIng" id="newIng">
                                    <table border="0" cellpadding="5">
                                        <tr>
                                            <td colspan="2" class="col_text">Supply known values for 100g of this ingredient:</td>
                                        </tr> 
                                        <tr>
                                            <div class="form-group">
                                                <td>
                                                    <label for="ingredientName" class="col_text">Ingredient Name: </label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="ingredientName" id="ingredientName" required />
                                                </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <td>
                                                    <label for="scientificName" class="col_text">Scientific Name: </label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="scientificName" id="scientificName" />
                                                </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                                <td>
                                                    <label for="calories" class="col_text">Calories: </label>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="calories" id="calories" min="0" />
                                                </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="fat" class="col_text">Fat (g): </label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="fat" id="fat" min="0" />
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="protein" class="col_text">Protein (g): </label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="fat" id="fat" min="0" />
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="carbs" class="col_text">Carbohydrates (g): </label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="carbs" id="carbs" min="0" />
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="sugar" class="col_text">Sugar (g): </label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="sugar" id="sugar" min="0" />
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="v_m" class="col_text">Vitamins & Minerals: </label>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control" name="v_m" id="v_m" min="0" />
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                        </tr>                    
                                    </table>
                                </form>
                            </div>
                        </div>
                    );
                    return body;
                }
            }

            class TipsForm extends React.Component {
                constructor(props) {
                    super(props);
                }

                render() {
                    let body = (
                        <div align="center">
                            <div>
                                <form action="#" method="post" name="newTip" id="newTip">
                                    <table border="0" cellpadding="5">
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="category" class="col_text">Category: </label>
                                            </td>
                                            <td>
                                                <select name="category" class="form-control" id="categoryList" form="newTip" required>
                                                    <option value="Cooking">Cooking</option>
                                                    <option value="Preparation">Preparation</option>
                                                    <option value="FixingMistakes">Fixing mistakes</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="content" class="col_text">Method: </label>
                                            </td>
                                            <td>
                                                <textarea name="content" class="form-control" id="content" form="newTip" rows="5" cols="30" required></textarea>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="userId" id="userId" value="" />
                                        </tr>   
                                        <tr>
                                        </tr>                    
                                    </table>
                                </form>
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    );
                    return body;
                }
            }

            class RecipeForm extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        units: ["ml", "cups", "oz", "tbsp", "tsp", "g", "lbs"],
                        allIngs: ["tomato", "onion", "chilly", "sugar"]
                    };
                }

                render() {
                   // Console.log("Recipe form");
                    let body = (
                        <div align="center">
                            <div>
                                <form action="" method="post" name="newRecipe" id="newRecipe">
                                    <table border="0" cellpadding="5">
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="recipeName" class="col_text">Recipe Name: </label>
                                            </td>
                                            <td><input type="text" class="form-control" name="recipeName" required /></td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="category" class="col_text">Category: </label>
                                            </td>
                                            <td>
                                                <select name="category" class="form-control" id="categoryList" form="newRecipe" required>
                                                    <option value="veg">Vegetarian</option>
                                                    <option value="non-veg">Non-Vegetarian</option>
                                                </select>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="cuisine" class="col_text">Cuisine: </label>
                                            </td>
                                            <td>
                                                <select name="cuisine" class="form-control" id="cuisineList" form="newRecipe" required>
                                                    <option value="Indian">Indian</option>
                                                    <option value="Chinese">Chinese</option>
                                                    <option value="Thai">Mexican</option>
                                                    <option value="French">French</option>
                                                    <option value="Italian">Italian</option>
                                                    <option value="American">American</option>
                                                    <option value="British">British</option>
                                                    <option value="Spanish">Spanish</option>
                                                    <option value="Arabic">Arabic</option>
                                                    <option value="Fusion or Continental">Fusion or Continental</option>
                                                    <option value="Other" selected>Other</option>
                                                </select>
                                            </td>
                                            </div> 
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="ing" class="col_text">Ingredients: </label>
                                            </td>
                                            <td>
                                                If you don't see your ingredient here, you can add using the "A New Ingredient" button.
                                                <select name="ing" id="idList" class="form-control" form="newRecipe" required multiple>
                                                    <option value="Tomatoes">Tomatoes</option>
                                                    <option value="Potatoes">Potatoes</option>
                                                    <option value="Coconut">Coconut</option>
                                                    <option value="Jaggery">Jaggery</option>
                                                    <option value="Ghee">Ghee</option>
                                                    <option value="Mustard Oil">Mustard Oil</option>
                                                    <option value="Chillies">Chillies</option>
                                                    <option value="Salt">Salt</option>
                                                    <option value="Onions">Onions</option>
                                                    <option value="Milk">Milk</option>
                                                    <option value="Sugar">Sugar</option>
                                                </select>
                                                Hold the Ctrl key down & select all the required ingredients.
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="qty" class="col_text">Comma separated quantities: </label>
                                            </td>
                                            <td><input type="text" class="form-control" name="qty" id="qty" required /></td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="method" class="col_text">Method: </label>
                                            </td>
                                            <td>
                                                <textarea name="method" class="form-control" id="method" form="newRecipe" rows="5" cols="30" required></textarea>
                                            </td>
                                            </div>
                                        </tr>
                                        <tr>
                                            <input type="hidden" name="upvotes" id="upvotes" value="0" />    
                                            <input type="hidden" name="downvotes" id="downvotes" value="0" />
                                            <input type="hidden" name="userId" id="userId" value="" />
                                            <div class="form-group">
                                            <td>
                                                <label for="recipePic" class="col_text">Recipe Image: </label>
                                            </td>
                                            <td>
                                                <input type="file" class="form-control" name="recipePic" id="recipePic" accept="image/*" />
                                            </td>
                                            </div>
                                        </tr>   
                                        <tr>
                                            <div class="form-group">
                                            <td>
                                                <label for="userName" class="col_text">User Name:</label>
                                            </td>
                                            <td>
                                                <input type="hidden" name="userName" id="userName" value="Rini" />Rini                                        
                                            </td>
                                            </div>
                                        </tr> 
                                        <tr>
                                        </tr>                    
                                    </table>
                                </form>
                            </div>
                        </div>
                    );
                    //Console.log("Gone");
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

            class AccordionElement extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        ing: this.props.ingName
                    }
                }

                render() {
                    let body = (
                        <div class="panel panel-default">
                            <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                {this.state.ing}</a>
                            </h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <b>Scientific Name:</b> Sodium Chloride<br />
                                <b>Calories:</b> 0 KCal<br />
                                <b>Sugar:</b> 0 g <br />
                            </div>
                            </div>
                        </div>
                    );
                }
            }

            class IngParser extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        ings: ["Tomatoes", "Potatoes", "Coconut", "Jaggery", "Ghee", "Mustard Oil", "Chillies", "Salt", "Onions", "Milk"],
                        m: []
                    }
                }

                getIngs = (e) => {
                    var txt = e.target.value;
                    var ar = this.state.ings;
                    var reg = new RegExp(ar.join("|"), 'gi');
                    var matches = txt.match(reg) || [];
                    this.setState({m: matches});
                }

                render() {
                    var match = this.state.m;
                    var acc = [];
                    if (match.length != 0) {
                        for (var i = 0; i < match.length; i++) {
                            var colLink = "#collapse"+i;
                            var coll = "collapse"+i; 
                            acc.push(
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordion" href={colLink}>
                                        {match[i]}</a>
                                    </h4>
                                    </div>
                                    <div id={coll} class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <b>Scientific Name:</b> NA<br />
                                        <b>Calories:</b> 0 KCal<br />
                                        <b>Sugar:</b> 0 g <br />
                                    </div>
                                    </div>
                                </div>
                            );
                        }
                    }
                    let body = (
                        <div>
                            <h3 class="col_text">Know what you need</h3>
                            <hr />
                            <div>
                                <div class="col-lg-6">
                                    <form>
                                        <b>Enter a segment of your recipe and we'll filter out the ingredients for you to know better:</b>
                                    <textarea class="form-control" rows="9" onBlur={this.getIngs}></textarea>
                                    </form>
                                </div>    
                                <div class="col-lg-6">
                                    <div class="panel-group" id="accordion">
                                        {acc}
                                    </div>
                                </div> 
                            </div>
                        </div>
                    );
                    return body;
                }
            }

            class Favorites extends React.Component {
                constructor(props) {
                    super(props);
                    this.state = {
                        userName: this.props.userName,
                        userId: this.props.userId
                    };
                }

                showRecipe = (e) => {
                    PageBody.setState({section: "Recipe"});
                }

                render() {
                    let body = '';
                    let list = (
                        <ul>
                            <li>
                                <a onClick={this.showRecipe}>Coconut Laddu</a>
                            </li>
                        </ul>
                    );
                    //get bookmarked list func

                    body = (
                        <div>
                            <h3 class="col_text">Here are your bookmarked recipes, Rini</h3>
                            <hr />
                            <div class="col-lg-2"></div>
                            {list}
                            <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class Indian extends React.Component {
                constructor(props) {
                    super(props);
                }

                showRecipe = (e) => {
                    PageBody.setState({section: "Recipe"});
                }

                render() {
                    let body = '';
                    let list = (
                        <ul>
                            <li>
                                <a onClick={this.showRecipe}>Coconut Laddu</a>
                            </li>
                        </ul>
                    );

                    body = (
                        <div>
                            <h3 class="col_text">Indian Recipes</h3>
                            <hr />
                            <div class="col-lg-2"></div>
                            {list}
                            <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class OneTip extends React.Component {
                constructor(props) {
                    super(props);
                }

                render() {
                    let body = '';
                    
                    body = (
                        <div>
                            <h3 class="col_text">Tips & Tricks</h3>
                            <hr />
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <p><u>Rini</u> suggested this <b>Cooking tip</b>:</p>
                                <i>Are you out of tomato puree? You can use tomato ketchup instead in your gravies. But keep in mind that it is sweet and already contains a little salt.</i>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class Tips extends React.Component {
                constructor(props) {
                    super(props);
                }

                showTip = (e) => {
                    PageBody.setState({section: "OneTip"});
                }

                render() {
                    let body = '';
                    let list = (
                        <ul>
                            <li>
                                <a onClick={this.showTip}>Cooking tip by Rini</a>
                            </li>
                        </ul>
                    );
                    body = (
                        <div>
                            <h3 class="col_text">Tips & Tricks</h3>
                            <hr />
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                {list}
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class Search extends React.Component {
                constructor(props) {
                    super(props);
                }

                showRecipe = (e) => {
                    PageBody.setState({section: "Recipe"});
                }

                render() {
                    let body = '';
                    let list = (
                        <ul>
                            <li>
                                <a onClick={this.showRecipe}>Coconut Laddu</a>
                            </li>
                        </ul>
                    );

                    body = (
                        <div>
                            <h3 class="col_text">Search Results</h3>
                            <hr />
                            <div class="col-lg-2"></div>
                            {list}
                            <div class="col-lg-2"></div>
                        </div>
                    );

                    return body;
                }
            }

            class Account extends React.Component {
                constructor(props) {
                    super(props);
                }

                render() {
                    let picStyle = {
                        border: "5px solid #CC5500",
                        borderRadius: "5px"
                    };
                    let body = '';
                    body = (
                        <div>
                        <div class="col-lg-2"></div>
                        <table cellpadding="5" class="col-lg-8">
                            <tr>
                                <td>
                                    <br />
                                    <i class="fa fa-pencil" title="Edit" aria-hidden="true" style={{color: "green"}}></i>&nbsp; &nbsp;
                                    <i class="fa fa-arrow-down" title="Downvotes" aria-hidden="true" style={{color: "#CC5500"}}></i>
                                    <span id="upvoteC" style={{color: "#CC5500"}}>0</span>&nbsp; &nbsp;
                                    <i class="fa fa-arrow-up" title="Upvotes" aria-hidden="true" style={{color: "#CC5500"}}></i>
                                    <span id="downvoteC" style={{color: "#CC5500"}}>0</span>&nbsp; &nbsp;
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" class="col_text"><h4>Rini</h4><hr /></td>
                            </tr> 
                            <tr>
                                <td align="left">
                                    <p>
                                        <b>Email: </b>raycan7@gmail.com
                                    </p>
                                    <p>
                                        <b>Tips Contributed:</b>1
                                    </p>
                                    <p>
                                        <b>Recipes Contributed:</b>1
                                    </p>
                                </td>
                                <td align="right">
                                    <img src="flower.jpg" width="200px" height="200px" style={picStyle} />
                                </td>
                            </tr>
                        </table>
                        <div class="col-lg-2"></div>
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
                    } else if (this.state.section == "Tips") {
                        body = <Tips />;
                    } else if (this.state.section == "OneTip") {
                        body = <OneTip />;
                    }  else if (this.state.section == "Favorites") {
                        body = <Favorites userId="0" userName="ABC" />;
                    } else if (this.state.section == "Recipe") {
                        body = <RecipeCard />;
                    } else if (this.state.section == "Indian") {
                        body = <Indian />;
                    } else if (this.state.section == "Account") {
                        body = <Account />;
                    } else if (this.state.section == "Search") {
                        body = <Search />;
                    } else {
                        body = <Home />;
                    }
                    
                    return body;
                }
            }
            ReactDOM.render(<PageBody ref={PageBody => {window.PageBody = PageBody}} />, document.getElementById('page_content'));

        </script>
        <script type="text/javascript">
            
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

            function getFavorites() {
                PageBody.setState({section: "Favorites"});
            }

            function getIndian() {
                PageBody.setState({section: "Indian"});
            }

            function getRecipe() {
                PageBody.setState({section: "Recipe"});
            }

            function getTips() {
                PageBody.setState({section: "Tips"});
            }

            function getRegistrationForm() {
                document.getElementById('reg').style.display='block'
                PageBody.setState({section: "Register"});
            }

            function getAccount() {
                PageBody.setState({section: "Account"});
            }

            function getSearch() {
                if (document.getElementById("searchtext").value == "coconut") {
                    PageBody.setState({section: "Search"});
                } else {
                    alert("No results found");
                }
            }

            function register() {
                //Console.log("Blah");
                if (document.getElementById('regname').value == "Ray") {
                    alert("A profile by this email already exists!");
                } else {
                    alert("Registration successful! Please login to continue.");
                }
            }

        </script>

        <div>
            <nav class="navbar navbar-inverse">
                <div>
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand navbar-brand-centered" onclick="getHome();">
                            <img src="logo.png" class="logo" alt="Creme de la Rasoi" />
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li onclick="getIngParser();"><a href="#">Know what you need</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Recipes by Category <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li onclick="getIndian();"><a href="#">Indian</a></li>
                                <li><a href="#">Chinese</a></li>
                                <li><a href="#">Mexican</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">Italian</a></li>
                                <li><a href="#">American</a></li>
                                <li><a href="#">British</a></li>
                                <li><a href="#">Spanish</a></li>
                                <li><a href="#">Arabic</a></li>
                                <li><a href="#">Fusion or Continental</a></li>
                                <li><a href="#">Other</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Vegetarian</a></li>
                                <li role="separator" class="divider"></li>
                                <li><a href="#">Non-Vegetarian</a></li>
                            </ul>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li data-toggle="modal" data-target="#search"><a href="#">Search Recipes</a></li>
                                <li><a href="#">Search Tips</a></li>
                                <li><a href="#">Search Ingredients</a></li>
                            </ul>
                        </li>
                    </ul>
                    <!--<form class="navbar-form navbar-left">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search">
                        </div>
                    </form>-->
                    <ul class="nav navbar-nav navbar-right">
                        <li data-toggle="modal" data-target="#converter">
                            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                                width="50" height="50"
                                viewBox="0 0 226 226"
                                style=" fill:#cc5500;">
                                <g transform="">
                                    <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                                        <path d="M0,226v-226h226v226z" fill="#cc5500"></path>
                                        <g fill="#ffffff">
                                            <path d="M69.09773,50.23645c-11.21638,0 -20.34,9.12362 -20.34,20.34v88.14c0,11.21638 9.12362,20.34 20.34,20.34h88.14c11.21638,0 20.34,-9.12362 20.34,-20.34v-88.14c0,-11.21638 -9.12362,-20.34 -20.34,-20.34zM69.09773,54.75645h88.14c8.72134,0 15.82,7.09866 15.82,15.82v88.14c0,8.72134 -7.09866,15.82 -15.82,15.82h-88.14c-8.72134,0 -15.82,-7.09866 -15.82,-15.82v-88.14c0,-8.72134 7.09866,-15.82 15.82,-15.82zM65.70773,66.05645c-0.62376,0 -1.13,0.50624 -1.13,1.13v20.34c0,0.62376 0.50624,1.13 1.13,1.13c0.62376,0 1.13,-0.50624 1.13,-1.13v-19.21h92.66v22.6h-77.97c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h79.1c0.62376,0 1.13,-0.50398 1.13,-1.13v-24.86c0,-0.62376 -0.50624,-1.13 -1.13,-1.13zM144.80773,71.98895c-0.9266,0 -1.72357,0.33314 -2.38801,0.99758c-0.66444,0.66444 -0.99758,1.46141 -0.99758,2.38801v8.48383c0,0.92886 0.33314,1.72357 0.99758,2.38801c0.66444,0.66444 1.46141,0.99758 2.38801,0.99758h3.40324c0.92886,0 1.72131,-0.33745 2.38801,-1.00641c0.66444,-0.67122 0.99316,-1.46162 0.99316,-2.37918v-8.48383c0,-0.92434 -0.32872,-1.71689 -0.99316,-2.38359c-0.6667,-0.66896 -1.46141,-1.00199 -2.38801,-1.00199zM146.50715,73.68836c0.87914,0 1.43574,0.46814 1.66852,1.39926l-3.36793,6.05168v-5.76477c0,-0.46104 0.17098,-0.85958 0.5032,-1.1918c0.33222,-0.33222 0.73065,-0.49437 1.19621,-0.49437zM148.20656,78.09801v5.76035c0,0.45652 -0.16441,0.84849 -0.49437,1.18297c-0.32996,0.33448 -0.7327,0.5032 -1.20504,0.5032c-0.46556,0 -0.83878,-0.11798 -1.11676,-0.35754c-0.27798,-0.23956 -0.45931,-0.59586 -0.54293,-1.0682zM72.48773,90.91645c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h4.52c0.62376,0 1.13,-0.50624 1.13,-1.13c0,-0.62376 -0.50624,-1.13 -1.13,-1.13zM74.32398,102.21645c-5.37202,0 -9.74625,4.36981 -9.74625,9.74183v41.53192c0,5.37202 4.37423,9.74625 9.74625,9.74625h77.69191c5.37202,0 9.74184,-4.36982 9.74184,-9.74184v-41.53633c0,-5.37202 -4.36982,-9.74183 -9.74184,-9.74183zM74.32398,104.47645h37.71375v27.12h-45.2v-19.63817c0,-4.12902 3.35949,-7.48183 7.48625,-7.48183zM114.29773,104.47645h37.71816c4.12902,0 7.48184,3.35507 7.48184,7.48183v19.63817h-45.2zM138.02773,108.93465c-0.62376,0 -1.13,0.50624 -1.13,1.13v5.7118h-5.65c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h5.65v5.65c0,0.62376 0.50624,1.13 1.13,1.13c0.62376,0 1.13,-0.50398 1.13,-1.13v-5.65h5.65c0.62376,0 1.13,-0.50624 1.13,-1.13c0,-0.62376 -0.50624,-1.13 -1.13,-1.13h-5.65v-5.7118c0,-0.62376 -0.50624,-1.13 -1.13,-1.13zM83.78773,115.77645c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h13.56c0.62376,0 1.13,-0.50624 1.13,-1.13c0,-0.62376 -0.50624,-1.13 -1.13,-1.13zM66.83773,133.85645h45.2v12.43c0,0.62376 0.50624,1.13 1.13,1.13c0.62376,0 1.13,-0.50398 1.13,-1.13v-12.43h45.2v19.63816c0,4.12902 -3.35508,7.48184 -7.48184,7.48184h-37.71816v-5.65c0,-0.62376 -0.50624,-1.13 -1.13,-1.13c-0.62376,0 -1.13,0.50624 -1.13,1.13v5.65h-37.71375c-4.12902,0 -7.48625,-3.35508 -7.48625,-7.48184zM85.15168,140.62762c-0.28928,0 -0.57859,0.11071 -0.79894,0.33106c-0.4407,0.4407 -0.4407,1.15719 0,1.59789l4.29488,4.29488l-4.29488,4.29488c-0.4407,0.4407 -0.4407,1.15719 0,1.59789c0.22148,0.21922 0.51408,0.33105 0.80336,0.33105c0.28928,0 0.57531,-0.11183 0.79453,-0.33105l4.29488,-4.29488l4.29488,4.29488c0.22148,0.21922 0.51408,0.33105 0.80336,0.33105c0.28928,0 0.57531,-0.11183 0.79453,-0.33105c0.4407,-0.4407 0.4407,-1.15719 0,-1.59789l-4.29488,-4.29488l4.29488,-4.29488c0.4407,-0.4407 0.4407,-1.15719 0,-1.59789c-0.4407,-0.4407 -1.15719,-0.4407 -1.59789,0l-4.29488,4.29488l-4.29488,-4.29488c-0.22035,-0.22035 -0.50967,-0.33106 -0.79895,-0.33106zM131.24773,142.89645c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h11.3c0.62376,0 1.13,-0.50624 1.13,-1.13c0,-0.62376 -0.50624,-1.13 -1.13,-1.13zM131.24773,149.67645c-0.62376,0 -1.13,0.50624 -1.13,1.13c0,0.62376 0.50624,1.13 1.13,1.13h11.3c0.62376,0 1.13,-0.50624 1.13,-1.13c0,-0.62376 -0.50624,-1.13 -1.13,-1.13z"></path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </li>
                        <li onclick="getTips();"><a href="#">Tips & Tricks</a></li>
                        <li onclick="getAbout();"><a href="#">About Us</a></li>
                        <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick="">Hello 
                            <span id="uname">Rini</span> <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li onclick="getAccount()";><a href="#">My Account</a></li>
                            <li  onclick="getContributor();"><a href="#">Contribute</a></li>
                            <li onclick="getFavorites();"><a href="#">Favorites</a></li>
                            <li role="separator" class="divider"></li>
                            <li onclick="logout();"><a href="index1.php">Log Out</a></form></li>
                        </ul>
                        <script type="text/javascript">
                            function login() {
                                let form = document.getElementById("loginForm");
                                if (document.getElementById('loginEmail').value == "abhi@gmail.com") {
                                    form.setAttribute("action", "index1.php");
                                    alert("A profile by this email does not exist.");
                                } else if (document.getElementById('loginPsw').value == "somePwd678") {
                                    form.setAttribute("action", "index1.php");
                                    alert("Invalid Credentials!");
                                } else {
                                    //window.stop();
                                    form.setAttribute("action", "iindex1.php");
                                }
                            }

                            function logout() {
                                alert("You have logged out!");
                            }            
                        </script>

                        </li>
                    </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
            <div class="modal fade" id="converter" tabindex="-1" role="dialog" aria-labelledby="converterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title" id="converterTitle">
                                <b class="col_text">Measurement Converter</b>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="clearConverter();">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </h3>
                        </div>
                        <div class="modal-body col-lg-12">
                            <p>Choose type:</p>
                            <p id="calc"></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn col_btn" data-dismiss="modal" onclick="clearConverter();">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="search" tabindex="-1" role="dialog" aria-labelledby="searchTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="searchTitle">
                            <b class="col_text">Search</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h3>
                    </div>
                    <div class="modal-body col-lg-12">
                        <div class="form-group">
                            <input type="text" name="searchtext" id="searchtext" class="form-control" placeholder="Type your search query..." />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn col_btn" data-dismiss="modal" onclick="getSearch();">Search</button>
                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
        </div>
        <!-- The Modal (contains the Sign Up form) -->
        <div id="reg" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="regTitle" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <form class="modal-content" method="post" onsubmit="register();">
                    <div class="modal-header">
                        <h3 class="modal-title" id="regTitle">
                            <b class="col_text">Register</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h3>
                    </div>
                    <div class="modal-body col-lg-12">
                        <p>Please fill in this form to create an account.</p>
                        <div class="form-group">
                            <label for="name" class="col_text"><b>Name:</b></label>
                            <input type="text" class="form-control" placeholder="Enter User Name" name="name" id="regname" required>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col_text"><b>Email:</b></label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="regemail" required>
                        </div>

                        <div class="form-group">
                            <label for="psw" class="col_text"><b>Password</b></label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="psw" id="regpsw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>

                        <div class="form-group">
                            <label for="profilePic" class="col_text"><b>Profile Picture: </b></label>
                            <input type="file" class="form-control" placeholder="Upload your picture" name="profilePic" id="profilePic" accept="image/*" />
                        </div>

                        <label class="col_text">
                            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
                        </label>

                        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>      
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                        <button type="submit" id="butsave" class="signup btn col_btn">Register</button>
                    </div>
                </form>
            </div>
        </div>
                <!-- The Modal (contains the Sign In form) -->
        <div id="signin" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="signinTitle" aria-hidden="true" >
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <form class="modal-content" method="POST" onsubmit="login();" id="loginForm">
                    <div class="modal-header">
                        <h3 class="modal-title" id="signinTitle">
                            <b class="col_text">Sign In</b>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </h3>
                    </div>
                    <div class="modal-body col-lg-12">
                        <p>Please fill in this form to sign in to your account.</p>
                        <div class="form-group">
                            <label for="name" class="col_text"><b>Name:</b></label>
                            <input type="text" class="form-control" placeholder="Enter User Name" name="name" id="loginName" required>
                        </div>

                        <div class="form-group" class="col_text">
                            <label for="email"><b>Email:</b></label>
                            <input type="email" class="form-control" placeholder="Enter Email" name="email" id="loginEmail" required >
                        </div>

                        <div class="form-group">
                            <label for="psw" class="col_text"><b>Password</b></label>
                            <input type="password" class="form-control" placeholder="Enter Password" name="psw" id="loginPsw" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" 
                            title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-dismiss="modal">Close</button>
                        <button type="submit" class="signup btn col_btn">Sign In</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="contentBox container">
            <div id="page_content"></div>
        </div>
    </body>
</html>