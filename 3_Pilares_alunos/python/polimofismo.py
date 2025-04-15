class Animal:
    def fazer_som(self):
        pass

class Cachorro(Animal):
    def fazer_som(self):
        return "Au au!"

class Gato(Animal):
    def fazer_som(self):
        return "Miau!"

def comunicar_animal(animal):
    print(animal.fazer_som())

# Usando polimorfismo
rex = Cachorro()
felix = Gato()

# Exibindo os sons dos animais
print("Som do Rex:")
comunicar_animal(rex)    # Imprime: Au au!

print("\nSom do Felix:")
comunicar_animal(felix)  # Imprime: Miau!