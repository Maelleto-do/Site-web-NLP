#!/usr/bin/python3


import nltk
# # import nltk.tokenize
# nltk.data.path = ['/net/www/mtoyriontle/nltk_data/']
#
# from nltk.tokenize.punkt import PunktSentenceTokenizer


f = open("texte_test.txt", 'rU')
text = f.read()
print(text[0])


#
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
