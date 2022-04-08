import "./App.css";
import Calculator from "./components/Calculator";
import useMeteo from "./hooks/useMeteo";

function App() {
  const { meteo, user } = useMeteo();

  return (
    <main className="container">
      {user && (
        <div>
          <p>Utilisateur</p>
          <img src={user.picture.thumbnail} alt="" />
          <p>
            {user.name.title} {user.name.first} {user.name.last}
          </p>
        </div>
      )}
      {meteo && meteo.current_condition && (
        <div>
          <p>Météo actuel</p>
          <img src={meteo.current_condition.icon_big} alt="" />
        </div>
      )}
      <div className="container calculate">
        <div className="row">
          <div className="col-6 offset-3 title">
            <h1>calculatrice</h1>
          </div>
        </div>
        <Calculator />
      </div>
    </main>
  );
}

export default App;
