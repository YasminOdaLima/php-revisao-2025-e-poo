class Cachorro:
    def __init__(self, nome, comida, sono):
        self.nome = nome
        self.comida = comida
        self.sono = sono

    def comer(self):
        self.comida = max(self.comida - 1, 0)

    def dormir(self):
        self.sono = True

    def exibir_status(self):
        print(f"{self.nome} agora tem {self.comida} unidades de comida.")
        print(f"{self.nome} está com sono? {'Sim' if self.sono else 'Não'}")

# Criando vários cachorros
cachorros = [
    Cachorro("Nelson", 3, False),
    Cachorro("Jeremias", 1, True),
    Cachorro("Cléo", 247, True),
    Cachorro("Francisco", 5, True),
    Cachorro("Conan", 19, False),
    Cachorro("Leleco", 3, False),
    Cachorro("Babi", 13, True)
]

# Manipulando os cachorros
for cachorro in cachorros:
    cachorro.comer()

# Exibindo os resultados no terminal
for cachorro in cachorros:
    cachorro.exibir_status()