import pandas as pd
import numpy as np
import numpy as np
from mlxtend.frequent_patterns import apriori, association_rules
import matplotlib.pyplot as plt

trans=pd.read_table('checkout.txt', index_col=0)
print(trans)
support=4

ts=pd.get_dummies(trans.unstack().dropna()).groupby(level=1).sum()
    
print("data in form of 1 and 0 is ",ts)
collen, rowlen  =ts.shape

tssum=ts.sum(axis=1)
maxlen=tssum.loc[tssum.idxmax()]

items=list(ts.columns)

print("--------------------")
print("unique data array ", items)


from itertools import combinations
import pandas as pd
import numpy as np

from mlxtend.preprocessing import TransactionEncoder



def get_support(df):
    pp = []
    for cnum in range(1, len(ts.columns)+1):
        for cols in combinations(ts, cnum):
            s = df[list(cols)].all(axis=1).sum()
            pp.append([",".join(cols), s])
    sdf = pd.DataFrame(pp, columns=["Pattern", "Support"])
    return sdf;

s = get_support(ts)
q=s[s.Support >= 3]
print(q)
from mlxtend.frequent_patterns import fpgrowth
from mlxtend.frequent_patterns import association_rules
frequent_itemsets_fp=fpgrowth(ts, min_support=0.01, use_colnames=True)
print(frequent_itemsets_fp)
print("--------------------------------------")

frequent_itemsets_ap = apriori(ts, min_support=0.01, use_colnames=True)
rules_ap = association_rules(frequent_itemsets_ap, metric="confidence", min_threshold=0.98)
rules_fp = association_rules(frequent_itemsets_fp, metric="confidence", min_threshold=0.98)
print(rules_ap)
print(rules_fp)

frequent = apriori(ts, min_support=0.01, use_colnames=True)
print("frequent items", frequent)
rules = association_rules(frequent, metric="lift", min_threshold=3)
print(rules.head())
