from abc import ABC, abstractmethod

class Animal(ABC):
    @abstractmethod
    def fazer_som(self):
        pass
    
    @abstractmethod
    def mover(self):
        pass

class Cachorro(Animal):
    def __init__(self, nome, comida, sono):
        self.__nome = nome
        self.__comida = comida
        self.__sono = sono
    
    def fazer_som(self):
        return "Au au!"
    
    def mover(self):
        return "Andando com 4 patas"

# Exibição no terminal
if __name__ == "__main__":
    rex = Cachorro(nome="Rex", comida=3, sono=5)
    
    print("Som do Rex:")
    print(rex.fazer_som())  # Imprime: Au au!
    
    print("\nMovimento do Rex:")
    print(rex.mover())      # Imprime: Andando com 4 patas