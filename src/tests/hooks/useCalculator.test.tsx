import { renderHook } from "@testing-library/react-hooks";
import useCalculator from "../../hooks/useCalculator";

test("show multiple examples", () => {
    const { result } = renderHook(() => useCalculator());
    const {
        addition,
        substraction,
        division,
        modulo,
        square
    } = result.current;

    expect(addition("2", "1")).toEqual("3");
    expect(substraction("2", "1")).toEqual("1");
    expect(division("6", "2")).toEqual("3");
    expect(modulo("4", "2")).toEqual("0");
    expect(square("4")).toEqual("2");
    /*expect(testAssertEquals()).toEqual("same");
    expect(1).not.toBeNaN();
    expect(testToBeInstanceOf()).toBeInstanceOf(User);
    const fnTest = jest.fn(testToHaveReturned);
    fnTest();
    expect(fnTest).toHaveReturnedWith(0);*/
});
