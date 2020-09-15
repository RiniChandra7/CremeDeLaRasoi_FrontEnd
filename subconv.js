            class SubConverter extends React.Component {
                //https://www.traditionaloven.com/culinary-arts/sugars/granulated-sugar/granulated-sugar-multimenu.html
                constructor(props) {
                    super(props);
                    this.state = {
                        type: this.props.ingType,
                        inputType: "none",
                        dryOutputType: ["g", "cups", "oz", "lbs", "tbsp", "tsp"],
                        dryOutputQty: {
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
                        },
                        wetOutputType: ["ml", "cups", "oz", "tbsp", "tsp"],
                        wetOutputQty: {
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
                        var allOp = '';
                        var units = '';
                        if (this.state.type == "Wet") {
                            allOp = this.state.wetOutputQty[inp];
                            units = this.state.wetOutputType;
                        } else if (this.state.type == "Dry") {
                            allOp = this.state.dryOutputQty[inp];
                            units = this.state.dryOutputType;
                        }
                        //allOp = this.state.outputQty[inp];

                        //var units = '';

                        //units = this.state.outputType;
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

                    let inputPart = '';
                    if (this.state.type == "Dry") {
                        inputPart = (
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
                    } else if (this.state.type == "Wet") {
                        inputPart = (
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
                    }
                    return inputPart;
                }
            }
