import { renderHook, act } from "@testing-library/react-hooks";
import useCalculatorView from "../../hooks/useCalculatorView";

test("show result", () => {
  const { result } = renderHook(() => useCalculatorView());
  const { addResult } = result.current;
  act(() => addResult("new result"));
  const { result: resultText } = result.current;
  expect(resultText).toEqual("new result");
});
