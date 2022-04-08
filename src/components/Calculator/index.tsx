import React from "react";
import useCalculatorView from "../../hooks/useCalculatorView";
import Result from "../Result";

const Calculator = () => {
  const { result, addResult } = useCalculatorView();
  return (
    <React.Fragment>
      <Result value={result} />
      <div className="row keyboard">
        <div className="col-3">
          <div className="touch" data-value="1" onClick={() => addResult("1")}>
            1
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="2" onClick={() => addResult("2")}>
            2
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="3" onClick={() => addResult("3")}>
            3
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="+" onClick={() => addResult("+")}>
            +
          </div>
        </div>
      </div>
      <div className="row keyboard">
        <div className="col-3">
          <div className="touch" data-value="4" onClick={() => addResult("4")}>
            4
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="5" onClick={() => addResult("5")}>
            5
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="6" onClick={() => addResult("6")}>
            6
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="-" onClick={() => addResult("-")}>
            -
          </div>
        </div>
      </div>
      <div className="row keyboard">
        <div className="col-3">
          <div className="touch" data-value="7" onClick={() => addResult("7")}>
            7
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="8" onClick={() => addResult("8")}>
            8
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="9" onClick={() => addResult("9")}>
            9
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="/" onClick={() => addResult("/")}>
            /
          </div>
        </div>
      </div>
      <div className="row keyboard">
        <div className="col-3">
          <div className="touch" data-value="%" onClick={() => addResult("%")}>
            %
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="0" onClick={() => addResult("0")}>
            0
          </div>
        </div>
        <div className="col-3">
          <div
            className="touch"
            data-value="√x"
            onClick={() => addResult("√x")}
          >
            √x
          </div>
        </div>
        <div className="col-3">
          <div className="touch" data-value="C" onClick={() => addResult("C")}>
            C
          </div>
        </div>
      </div>
      <div className="row keyboard">
        <div className="col-3 offset-9">
          <div className="touch" data-value="=" onClick={() => addResult("=")}>
            =
          </div>
        </div>
      </div>
    </React.Fragment>
  );
};

export default Calculator;
