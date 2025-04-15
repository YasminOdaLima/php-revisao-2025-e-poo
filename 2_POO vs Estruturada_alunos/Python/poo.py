#Classe Cachorro (É como se fosse um molde de criação)
class Cachorro:
    def __init__(self, nome, comida, sono):
        self.nome = nome
        self.comida = comida
        self.sono = sono
    
    def comer(self):
        self.comida -= 1
    
    def dormir(self):
        self.sono = False

# Criando (Objetos)
cachorro_1 = Cachorro("Nelson", 3, False)
cachorro_2 = Cachorro("Jeremias", 1, True)

# Usando métodos
cachorro_1.comer()
cachorro_2.dormir()

# Exibindo os resultados no terminal
print(f"{cachorro_1.nome} agora tem {cachorro_1.comida} unidades de comida.")
print(f"{cachorro_2.nome} está com sono? {cachorro_2.sono}")