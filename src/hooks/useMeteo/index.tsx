import { useEffect, useState } from "react";

const useMeteo = () => {
  const [meteo, setMeteo] = useState<any>();
  const [user, setUser] = useState<any>();

  const loadRandomUser = () => {
    fetch("https://randomuser.me/api")
      .then((res) => res.json())
      .then((res) => {
        setUser(res.results[0]);
      });
  };

  const loadMeteo = () => {
    fetch("https://prevision-meteo.ch/services/json/aix-en-provence")
      .then((res) => res.json())
      .then((res) => {
        setMeteo(res);
      });
  };

  useEffect(() => {
    loadMeteo();
    loadRandomUser();
  }, []);

  return { meteo, user, loadMeteo, loadRandomUser };
};

export default useMeteo;
