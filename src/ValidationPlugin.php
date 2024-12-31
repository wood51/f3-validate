<?php 
class ValidationPlugin extends \Prefab
{
    /**
     * Valide une variable en fonction de son type attendu
     * @param mixed $value La valeur à valider
     * @param string $type Le type attendu (ex. "int", "string", "email", etc.)
     * @param array $options (Facultatif) Options supplémentaires pour les filtres
     * @return mixed La valeur validée ou une exception si invalide
     */
    public function validate($value, $type, $options = [])
    {
        switch ($type) {
            case 'int':
                if (!filter_var($value, FILTER_VALIDATE_INT, $options)) {
                    throw new \InvalidArgumentException("La valeur doit être un entier valide.");
                }
                return (int)$value;

            case 'string':
                if (!is_string($value) || empty(trim($value))) {
                    throw new \InvalidArgumentException("La valeur doit être une chaîne de caractères non vide.");
                }
                return trim($value);

            case 'email':
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    throw new \InvalidArgumentException("La valeur doit être une adresse email valide.");
                }
                return $value;

            case 'url':
                if (!filter_var($value, FILTER_VALIDATE_URL)) {
                    throw new \InvalidArgumentException("La valeur doit être une URL valide.");
                }
                return $value;

            default:
                throw new \InvalidArgumentException("Type de validation inconnu : $type.");
        }
    }
}