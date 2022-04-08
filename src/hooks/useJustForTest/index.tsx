export class User {}

const useJustForTest = () => {
  const testBoolTrue = () => true;
  const testAssertEquals = () => {
    return "same";
  };
  const testToBeInstanceOf = () => new User();

  const testToHaveReturned = () => {
    return 0;
  };

  const toContainEqual = () => {
    return [
      { delicious: true, sour: false },
      {
        a: "a",
        b: "b",
      },
    ];
  };

  const testToStrictEqual = () => {
    return [{ delicious: true, sour: false }];
  };

  const testToBeLessThan = () => {
    return 1000;
  };

  const testToBeNull = () => {
    return null;
  };

  return {
    testBoolTrue,
    testAssertEquals,
    testToBeInstanceOf,
    testToHaveReturned,
    // todo tests
    toContainEqual,
    testToStrictEqual,
    testToBeLessThan,
    testToBeNull,
  };
};

export default useJustForTest;
