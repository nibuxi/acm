#define _CRT_SECURE_NO_WARNINGS
#include <iostream>
#include <cstring>//memset()
#include <cstdio>
using namespace std;
int grid[11][4] = {//0~10分别表示A~K方格，0~4表示东南西北
	{ 0, 0, 1, 1 },//西北有水管接口
	{ 1, 0, 0, 1 },
	{ 0, 1, 1, 0 },
	{ 1, 1, 0, 0 },
	{ 0, 1, 0, 1 },
	{ 1, 0, 1, 0 },
	{ 1, 0, 1, 1 },
	{ 0, 1, 1, 1 },
	{ 1, 1, 1, 0 },
	{ 1, 1, 0, 1 },
	{ 1, 1, 1, 1 } };
int dir[4][2] = {//东南西北方向
	{ 0, 1 }, //东：同行，右
	{ 1, 0 },//南：下行
	{ 0, -1 },
	{ -1, 0 } };
int flag[55][55];//是否访问过这个方格
int s[55][55];
bool mrk = false;//全局标记
int n, m;
void dfs(int i, int j){//当前格子s[i][j]
	if (i <= 0 || i > m || j <= 0 || j > n) return;
	if (flag[i][j]) return;//已经访问过
	mrk = true; //表示flag[i][j]有标记过
	flag[i][j] = 1;//标记为已访问
	//判断当前方格的四个方向是不是有接口，如果某个方向有接口的话，
	//就判断这个方向上的下一个方格中，和当前方格相邻的边是不是有接口，
	//如果有接口，则继续深搜这个相邻的点
	for (int k = 0; k < 4; ++k){//[(k + 2) % 4]表示k的相对方向，东西
		if (grid[s[i][j]][k] && //当前格子s[i][j]的k方向
			grid[s[i + dir[k][0]][j + dir[k][1]]][(k + 2) % 4]){
			dfs(i + dir[k][0], j + dir[k][1]);
		}//s[i + dir[k][0]][j + dir[k][1]]表示当前格子s[i][j]的同k方向下个格子
	}
	return;
}
int main(void){
	while (~scanf("%d%d", &m, &n)){
		if (m + n < 0) break; 
		char ch; getchar();//吸收上行后的换行
		int cnt = 0;
		for (int i = 1; i <= m; ++i){//实际农场1~m行
			for (int j = 1; j <= n; ++j){
				scanf("%c", &ch);
				//实际的农场格子，转为数值，在grid中作行下标，表示某格
				s[i][j] = ch - 'A';
			} 
			getchar();
		}
		memset(flag, 0, sizeof(flag));
		for (int i = 1; i <= m; ++i){
			for (int j = 1; j <= n; ++j){
				mrk = false;
				if (!flag[i][j]) dfs(i, j);
				if (mrk) cnt++;
			}
		}
		printf("%d\n", cnt);
	}
	return 0;
}