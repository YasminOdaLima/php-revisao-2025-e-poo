# Funções para manipular os dados
def comer(quantidade_comida):
    return max(quantidade_comida - 1, 0)

def dormir():
    return True

# Criando vários cachorros
cachorros = [
    {"nome": "Nelson", "comida": 3, "sono": False},
    {"nome": "Jeremias", "comida": 1, "sono": True},
    {"nome": "Cléo", "comida": 247, "sono": True},
    {"nome": "Francisco", "comida": 5, "sono": True},
    {"nome": "Conan", "comida": 19, "sono": False},
    {"nome": "Leleco", "comida": 3, "sono": False},
    {"nome": "Babi", "comida": 13, "sono": True}
]

# Manipulando os cachorros
for cachorro in cachorros:
    cachorro["comida"] = comer(cachorro["comida"])

# Exibindo os resultados no terminal
for cachorro in cachorros:
    print(f"{cachorro['nome']} agora tem {cachorro['comida']} unidades de comida.")
    print(f"{cachorro['nome']} está com sono? {'Sim' if cachorro['sono'] else 'Não'}")
