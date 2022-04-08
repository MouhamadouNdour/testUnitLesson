const Result = ({ value }: { value: string }) => {
  return (
    <div className="row">
      <div className="col-8 offset-2 result">{value}</div>
    </div>
  );
};

export default Result;
