#!/usr/bin/python3.5.3

import nltk
# nltk.download('nltk_data/tokenizers/punkt')
from nltk import word_tokenize
from nltk.tokenize import TreebankWordTokenizer
tokenizer = TreebankWordTokenizer()


def find_word():

    f = open("/net/www/mtoyriontle/texte_test.txt",'rU')
    text = f.read()
    text = text.lower()
    #print(text)
    f = open("/net/www/mtoyriontle/model/python/black_list.txt",'rU')
    text_black_list = f.read()
    # print nltk.word_tokenize(test)
    #print(text_black_list)
    text_token = tokenizer.tokenize(text)
    black_list_token = tokenizer.tokenize(text_black_list)

    common = set(text_token).intersection(black_list_token)

    #print(common)

    if len(common) > 0 :
        return 1
        #print("mot interdit dans le message")


    #print("pas de mots interdits")
    return 0

exit(find_word())


# def find_word():
#
#     f = open("texte_test.txt", 'rU')
#     res = nltk.word_tokenize(f)
#     for wd in res :
#         if wd == "moche":
#             return 1
#     return 0

# exit(find_word())

#
# def find_word():
#
#     f = open("texte_test.txt", 'rU')
#     for ligne in f :
#         phrase = ligne.split()
#         #print phrase
#         #print len(phrase)
#         for i in range(0,len(phrase)):
#             #print phrase[i]
#             if phrase[i] == "moche":
#                 return 1
#     return 0
#
#
#
# exit(find_word())
